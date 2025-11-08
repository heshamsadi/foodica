/**
 * External dependencies
 */
import classnames from 'classnames';
import { isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { category, stretchFullWidth } from '@wordpress/icons';
import {
	__unstableComposite as Composite, // eslint-disable-line
	__unstableUseCompositeState as useCompositeState, // eslint-disable-line
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import InserterNoResults from './../core-components/no-results';
import InserterListbox from './../core-components/inserter-listbox';
import useInsertionPoint from './../core-hooks/use-insertion-point';
import Pattern from './pattern';

/**
 * Renders the grid of block pattern previews.
 *
 * @since 0.1.0
 * @param {Object} props All the props passed to this function
 * @return {string}      Return the rendered JSX
 */
export default function PreviewPatternList( props ) {
	const {
		isGrid,
		isLoading,
		searchValue,
		shownPatterns,
		viewportWidth,
	} = props;

	const [ destinationRootClientId, onInsertBlocks ] = useInsertionPoint( { // eslint-disable-line
		shouldFocusBlock: true,
	} );

	const isError = isEmpty( shownPatterns ) && ! searchValue && ! isLoading;
	const noSearchResults = isEmpty( shownPatterns ) && searchValue;
	const hasPatterns = ! isError && ! noSearchResults;

	const noPatternsMessage =
		! hasPatterns && noSearchResults
			? __( 'No search results found.', 'block-patterns-for-food-bloggers' )
			: __(
					'No patterns were found for this category.',
					'block-patterns-for-food-bloggers'
			  );

	const composite = useCompositeState();
	const baseClassName = 'block-patterns-for-food-bloggers__preview-pattern-list';

	return (
		<InserterListbox>
			{ ! hasPatterns && (
				<InserterNoResults
					icon={ isGrid ? category : stretchFullWidth }
					label={ noPatternsMessage }
				/>
			) }
			{ hasPatterns && (
				<Composite
					{ ...composite }
					role="listbox"
					className={ classnames( baseClassName, {
						'is-grid': isGrid,
						'is-loading': isLoading,
						// TODO this needs reworking.
						'preview-tablet': viewportWidth === 778,
						'preview-mobile': viewportWidth === 358,
					} ) }
					aria-label={ __( 'Patterns', 'block-patterns-for-food-bloggers' ) }
				>
					{ shownPatterns.map( ( pattern ) => (
						<Pattern
							key={ pattern.name }
							pattern={ pattern }
							onInsertPattern={ onInsertBlocks }
							viewportWidth={ viewportWidth }
							composite={ composite }
						/>
					) ) }
				</Composite>
			) }
		</InserterListbox>
	);
}
