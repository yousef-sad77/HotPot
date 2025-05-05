
const html_debug_elements = `<div id="debug-overlay">
    <div class="panel" id="breakpoint-label">Breakpoint: ?</div>
    <button id="toggle-outline">Toggle Outline</button>
    <button id="toggle-position">Move up/down</button>
</div>`

const css_debug_style = `<style>
:root
        {
        --debug-outline-color: rgba(255, 0, 0, 0.5);
        --debug-panel-color: rgba(0, 0, 0, 0.75);
        --debug-toggler-outline-bg-color:rgba(155, 148, 148, 0.29);
        --debug-toggler-position-bg-color: rgba(108, 233, 166, 0.82);
        }

        #toggle-outline {
            background-color: var(--debug-toggler-outline-bg-color);
        }

        #toggle-position {
            background-color: var(--debug-toggler-position-bg-color);
        }

        #debug-overlay {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 9999;
            font-family: monospace;
            font-size: 14px;
        }

        #debug-overlay.top {
            bottom: 10px;
            top: unset;
        }

        #debug-overlay .panel {
            
            background: var(--debug-panel-color);
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        #debug-overlay button {
            cursor: pointer;
            color: #000;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 3px;
            border: none;
            margin-top: 4px;
            display: block;
        }

        .debug-outline * {
            outline: 1px dashed var(--debug-outline-color) !important;
        }
    </style>`


document.addEventListener('DOMContentLoaded', function () {
  const breakpoints = [
    { name: 'xxl', min: 1400 },
    { name: 'xl', min: 1200 },
    { name: 'lg', min: 992 },
    { name: 'md', min: 768 },
    { name: 'sm', min: 576 },
    { name: 'xs', min: 0 },
  ];

  document.body.insertAdjacentHTML('beforeend', html_debug_elements + css_debug_style);

  const overlay = document.getElementById('debug-overlay');
  const label = document.getElementById('breakpoint-label');
  const toggleOutlineBtn = document.getElementById('toggle-outline');
  const togglePositionBtn = document.getElementById('toggle-position');

  function updateBreakpoint() {
    const width = window.innerWidth;
    const current = breakpoints.find(bp => width >= bp.min);
    label.textContent = `Breakpoint: ${current.name} (${width}px)`;
  }

  toggleOutlineBtn.addEventListener('click', () => {
    document.body.classList.toggle('debug-outline');
  });

  togglePositionBtn.addEventListener('click', () => {
    overlay.classList.toggle('top');
  });

  window.addEventListener('resize', updateBreakpoint);
  updateBreakpoint();
});
