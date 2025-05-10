# Self-elevate the script if not running as admin
if (-not ([Security.Principal.WindowsPrincipal][Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole] "Administrator"))
{
    Write-Output "Restarting script as administrator..."
    Start-Process powershell -ArgumentList "-ExecutionPolicy Bypass -File `"$PSCommandPath`"" -Verb RunAs
    exit
}

# The port you want to free up
$port = 3306

# Try to find the process using the port
$connection = Get-NetTCPConnection -LocalPort $port -ErrorAction SilentlyContinue

if ($connection) {
    $targetPid = $connection.OwningProcess
    $proc = Get-Process -Id $targetPid -ErrorAction SilentlyContinue

    # IMPORTANT: Protect against killing self
    if ($targetPid -eq $PID) {
        Write-Output "Detected that the current script (pwsh.exe) is associated with port $port."
        Write-Output "Not killing the current script! Please check manually."
        exit
    }

    if ($proc) {
        Write-Output "Port $port is being used by process: $($proc.Name) (PID: $targetPid)"

        # Try to find if it's a service
        $service = Get-WmiObject Win32_Service | Where-Object { $_.ProcessId -eq $targetPid }

        if ($service) {
            Write-Output "Service detected: $($service.Name) ($($service.DisplayName))"
            Write-Output "Stopping service..."
            Stop-Service -Name $service.Name -Force
            Write-Output "Service stopped."
        } else {
            Write-Output "Not a service. Killing process..."
            Stop-Process -Id $targetPid -Force
            Write-Output "Process killed."
        }
    } else {
        Write-Output "Process with PID $targetPid not found."
    }
} else {
    Write-Output "No process found using port $port."
}
Read-Host "press any key to continue..."