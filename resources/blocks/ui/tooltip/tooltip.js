document.querySelectorAll('.tooltip_trigger').forEach(function(tooltipButton) {
    let tooltip = document.querySelector('.'+tooltipButton.getAttribute('data-tooltip'));
    let arrowElement = tooltip.querySelector('.tooltip__arrow');
    console.log(arrowElement);

    updateTooltip(tooltipButton, tooltip, arrowElement);

    tooltipButton.onclick = function() {
        toggleTooltip(tooltipButton, tooltip, arrowElement);
    };

    tooltipButton.onblur = function() {
        hideTooltip(tooltip);
    };
});


function updateTooltip(tooltipButton, tooltip, arrowElement) {
    computePosition(tooltipButton, tooltip, {
        placement: 'top',
        middleware: [
            offset(6),
            flip(),
            shift({padding: 16}),
            arrow({element: arrowElement}),
        ],
    }).then(({x, y, placement, middlewareData}) => {
        Object.assign(tooltip.style, {
            left: `${x}px`,
            top: `${y}px`,
        });

        // Accessing the data
        const {x: arrowX, y: arrowY} = middlewareData.arrow;

        const staticSide = {
            top: 'bottom',
            right: 'left',
            bottom: 'top',
            left: 'right',
        }[placement.split('-')[0]];

        Object.assign(arrowElement.style, {
            left: arrowX != null ? `${arrowX}px` : '',
            top: arrowY != null ? `${arrowY}px` : '',
            right: '',
            bottom: '',
            [staticSide]: '-4px',
        });
    });
}

function showTooltip(tooltipButton, tooltip, arrowElement) {
    tooltip.style.display = 'block';
    updateTooltip(tooltipButton, tooltip, arrowElement);
}


function toggleTooltip(tooltipButton, tooltip, arrowElement) {
    if (tooltip.style.display === 'none') {
        tooltip.style.display = 'block';
        updateTooltip(tooltipButton, tooltip, arrowElement);
    } else {
        tooltip.style.display = 'none';
    }
}

function hideTooltip(tooltip) {
    tooltip.style.display = 'none';
}
