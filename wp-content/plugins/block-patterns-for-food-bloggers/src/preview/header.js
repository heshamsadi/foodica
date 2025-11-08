/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __, _n, sprintf } from '@wordpress/i18n';
import {
	Button,
	DropdownMenu,
	MenuGroup,
	MenuItem,
	Spinner,
} from '@wordpress/components';
import { check, stretchFullWidth, category } from '@wordpress/icons';

/**
 * Renders the block pattern preview header.
 *
 * @since 0.1.0
 * @param {Object} props All the props passed to this function
 * @return {string}      Return the rendered JSX
 */
export default function PreviewHeader( props ) {
	const {
		viewportWidth,
		setViewportWidth,
		isGrid,
		setIsGrid,
		shownPatterns,
		searchValue,
		isLoading,
	} = props;

	const widths = [
		{
			label: __( 'Desktop', 'block-patterns-for-food-bloggers' ),
			slug: 'desktop',
			value: 1300,
			active: viewportWidth === 1300,
		},
		{
			label: __( 'Tablet', 'block-patterns-for-food-bloggers' ),
			slug: 'tablet',
			value: 778,
			active: viewportWidth === 778,
		},
		{
			label: __( 'Mobile', 'block-patterns-for-food-bloggers' ),
			slug: 'mobile',
			value: 358,
			active: viewportWidth === 358,
		},
	];

	function toggleWidths( width ) {
		if ( ! width.active ) {
			setViewportWidth( width.value );
		}
	}

	const baseClassName = 'block-patterns-for-food-bloggers__preview-header';

	return (
		<div className={ baseClassName }>
			<div className={ `${ baseClassName }__search-results` }>
				{ isLoading && <Spinner /> }
				{ searchValue &&
					searchValue.length > 1 &&
					sprintf(
						// translators: %1$d: Number of patterns. %2$s: The search input.
						_n(
							'%1$d search result for "%2$s"',
							'%1$d search results for "%2$s"',
							shownPatterns.length,
							'block-patterns-for-food-bloggers'
						),
						shownPatterns.length,
						searchValue
					) }
			</div>
			<div className={ `${ baseClassName }__controls` }>
				<DropdownMenu
					icon={ '' }
					text={ __( 'Preview', 'block-patterns-for-food-bloggers' ) }
					className="viewport-toggle"
					toggleProps={ { isTertiary: true } }
					popoverProps={ {
						focusOnMount: 'container',
						position: 'bottom left',
					} }
				>
					{ () => (
						<MenuGroup>
							{ widths.map( ( width ) => (
								<MenuItem
									key={ width.slug }
									className={ classnames( {
										disabled: ! width.active,
									} ) }
									icon={ width.active ? check : '' }
									onClick={ () => toggleWidths( width ) }
								>
									{ width.label }
								</MenuItem>
							) ) }
						</MenuGroup>
					) }
				</DropdownMenu>
				<Button
					label={ __(
						'Individual Pattern',
						'block-patterns-for-food-bloggers'
					) }
					icon={ stretchFullWidth }
					isPressed={ ! isGrid }
					onClick={ () => setIsGrid( ! isGrid ) }
				/>
				<Button
					label={ __( 'Grid View', 'block-patterns-for-food-bloggers' ) }
					icon={ category }
					isPressed={ isGrid }
					onClick={ () => setIsGrid( ! isGrid ) }
				/>
			</div>
		</div>
	);
}
