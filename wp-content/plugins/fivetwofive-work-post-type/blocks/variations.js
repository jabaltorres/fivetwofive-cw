wp.domReady(function () {
	const WORK_QUERY_LOOP_BLOCK_NAME = 'ftf-work/work-archive';

	wp.blocks.registerBlockVariation(
		'core/query',
		{
			name: WORK_QUERY_LOOP_BLOCK_NAME,
			title: 'Work Archive',
			isActive: ({namespace, query}) => {
				return (
					namespace === WORK_QUERY_LOOP_BLOCK_NAME
					&& query.postType === 'ftf_work'
				);
			},
			attributes: {
				namespace: WORK_QUERY_LOOP_BLOCK_NAME,
				className: 'is-style-ftf-work-archive-cards',
				query: {
					perPage: 9,
					pages: 0,
					offset: 0,
					postType: 'ftf_work',
					order: 'desc',
					orderBy: 'date',
					author: '',
					search: '',
					exclude: [],
					sticky: '',
					inherit: false,
				},
				displayLayout: {
					type: "flex",
					columns: 3
				}
			},
			innerBlocks: [
				[
					'core/post-template',
					{},
					[
						[
							'core/post-featured-image',
							{
								isLink: true,
								height: '250px',
								style: {
									spacing: {
										margin: {
											bottom: "0"
										}
									}
								}
							},
						],
						[
							'core/group',
							{
								style: {
									spacing: {
										padding: {
											top: 'var:preset|spacing|x-small',
											right: 'var:preset|spacing|x-small',
											bottom: 'var:preset|spacing|x-small',
											left: 'var:preset|spacing|x-small'
										}
									}
								},
								layout: {
									type: 'constrained'
								},
							},
							[
								[
									'core/post-title',
									{
										isLink: true,
										fontSize: 'medium'
									}
								],
								[
									'core/post-date',
									{
										fontSize: 'small'
									}
								]
							]
						],
					],
				],
				['core/spacer'],
				[
					'core/query-pagination',
					{
						layout: {
							type: 'flex',
							justifyContent: 'center'
						}
					}
				],
				['core/query-no-results'],
			],
			scope: ['inserter'],
		}
	);

	wp.blocks.registerBlockStyle(
		'core/query',
		{
			name: 'ftf-work-archive-cards',
			label: 'Cards'
		}
	);
});