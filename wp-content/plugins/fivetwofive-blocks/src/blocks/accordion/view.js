import Accordion from 'accordion-js';
document.addEventListener('DOMContentLoaded', () => {
	const accordions = document.querySelectorAll('.wp-block-fivetwofive-blocks-accordion');

	if (accordions.length > 0) {
		accordions.forEach((accordion) => {
			new Accordion(
				accordion,
				{
					onlyChildNodes: true,
					elementClass: 'wp-block-fivetwofive-blocks-panel',
					triggerClass: 'ftfb-panel-trigger',
					panelClass: 'ftfb-panel-collapse',
				}
			);
		});
	}
});