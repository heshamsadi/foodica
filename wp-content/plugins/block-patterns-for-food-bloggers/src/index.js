/**
 * External dependencies.
 */
import { isEmpty } from 'lodash';

/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';
import { render, useState, useMemo, useCallback } from '@wordpress/element';
import { dispatch, subscribe } from '@wordpress/data';
import { Button, Modal } from '@wordpress/components';
import { FoodBlogIcon } from './icon';

/**
 * Internal dependencies
 */
import FoodBlogPatterns from './food-blog-patterns';
import usePatternsState from './core-hooks/use-patterns-state';

/**
 * Render the header toolbar button and the accompanying pattern explorer modal.
 *
 * @since 0.1.0
 * @return {string} Return the rendered JSX for the Pattern Explorer Button
 */
function HeaderToolbarButton() {
	const [ isModalOpen, setIsModalOpen ] = useState( false );
	const [ allPatterns, allCategoryTypes ] = usePatternsState();

	//Add only needed categories
	const allCategories = [{ name : "wpz-featured", label : "WPZOOM: Food Blog Patterns" }];

	const fetchedCategoryTypes =
		allCategoryTypes === 'fetching' ? [] : allCategoryTypes;

	// Check if a pattern has an assigned pattern category.
	const hasRegisteredCategory = useCallback(
		( pattern ) => {
			if ( ! pattern.categories || ! pattern.categories.length ) {
				return false;
			}

			return pattern.categories.some( ( cat ) =>
				allCategories.some( ( category ) => category.name === cat )
			);
		},
		[ allCategories ]
	);

	// Check if a pattern category has an assigned pattern category type.
	const hasRegisteredCategoryType = useCallback(
		( category ) => {
			if ( ! category.categoryTypes || ! category.categoryTypes.length ) {
				return false;
			}

			return category.categoryTypes.some( ( type ) =>
				fetchedCategoryTypes.some(
					( categoryType ) => categoryType.name === type
				)
			);
		},
		[ fetchedCategoryTypes ]
	);

	// Remove any categories without patterns.
	const populatedCategories = useMemo( () => {
		const categories = allCategories
			.filter( ( category ) =>
				allPatterns.some( ( pattern ) =>
					pattern.categories?.includes( category.name )
				)
			)
			.sort( ( { name: currentName }, { name: nextName } ) => {
				if ( ! [ currentName, nextName ].includes( 'wpz-featured' ) ) {
					return 0;
				}
				return currentName === 'wpz-featured' ? -1 : 1;
			} );

		// If there are patterns without categories, create Uncategorized.
		if (
			allPatterns.some(
				( pattern ) => ! hasRegisteredCategory( pattern )
			) &&
			! categories.find(
				( category ) => category.name === 'uncategorized'
			)
		) {
			// categories.push( {
			// 	name: 'uncategorized',
			// 	label: __( 'Uncategorized', 'block-patterns-for-food-bloggers-collection' ),
			// } );
		}

		return categories;
	}, [ allPatterns, allCategories ] );

	// Remove any pattern category type without populated pattern categories.
	const populatedCategoryTypes = useMemo( () => {
		const categoryTypes = fetchedCategoryTypes.filter( ( type ) =>
			populatedCategories.some( ( category ) =>
				category.categoryTypes?.includes( type.name )
			)
		);

		// If there are categories without types, create the Uncategorized type.
		if (
			populatedCategories.some(
				( category ) => ! hasRegisteredCategoryType( category )
			) &&
			! categoryTypes.find( ( type ) => type.name === 'uncategorized' )
		) {
			categoryTypes.unshift( {
				name: 'uncategorized',
				label: __( 'Uncategorized', 'block-patterns-for-food-bloggers' ),
				hideLabelFromVision: true,
			} );
		}

		return categoryTypes;
	}, [ populatedCategories, fetchedCategoryTypes ] );

	// Could expand on this in the future, i.e. allow for a configurable
	// initial category. For now the initial category is the first category in
	// the first category type.
	const initialCategory = populatedCategories.filter( ( category ) => {
		// If the first category type is 'uncategorized', filter all categories
		// without types and all categories with the type 'uncategorized'.
		if ( populatedCategoryTypes[ 0 ].name === 'uncategorized' ) {
			return (
				! category.categoryTypes ||
				! category.categoryTypes.length ||
				category.categoryTypes?.includes( 'uncategorized' )
			);
		}

		// If the first type is not 'uncategorized', filter all the categories in the
		// first type.
		return category.categoryTypes?.includes(
			populatedCategoryTypes[ 0 ].name
		);
	} )[ 0 ];

	// If there are no patterns, do not display the pattern explorer button.
	if ( isEmpty( allPatterns ) ) {
		return null;
	}

	return (
		<>
			<Button
				icon={ FoodBlogIcon }
				label={ __( 'Explore Food Blog Patterns', 'block-patterns-for-food-bloggers' ) }
				onClick={ () => setIsModalOpen( true ) }
			/>
			{ isModalOpen && (
				<Modal
					title={ __( 'WPZOOM: Food Blog Patterns', 'block-patterns-for-food-bloggers' ) }
					closeLabel={ __( 'Close', 'block-patterns-for-food-bloggers-collection' ) }
					onRequestClose={ () => setIsModalOpen( false ) }
					className="block-patterns-for-food-bloggers-collection__modal"
					isFullScreen
				>
					<FoodBlogPatterns
						allPatterns={ allPatterns }
						initialCategory={ initialCategory }
						patternCategories={ populatedCategories }
						patternCategoryTypes={ populatedCategoryTypes }
						categoryTypes
					/>
				</Modal>
			) }
		</>
	);
}

/**
 * Add the header toolbar button to the block editor.
 */
subscribe( () => {
	const inserter = document.querySelector( '#block-patterns-for-food-bloggers-collection' );

	// If the inserter already exists, bail.
	if ( inserter ) {
		return;
	}

	wp.domReady( () => {
		
		var toolbar = document.querySelector(
			'.edit-post-header-toolbar__left'
		);

		// If no toolbar can be found at all, bail.
		if ( ! toolbar ) {
			toolbar = document.querySelector(
				'.editor-document-tools__left'
			);
		}

		// If no toolbar can be found at all, bail.
		if ( ! toolbar ) {
			return;
		}

		const buttonContainer = document.createElement( 'div' );
		buttonContainer.id = 'block-patterns-for-food-bloggers-collection';

		toolbar.appendChild( buttonContainer );

		render(
			<HeaderToolbarButton />,
			document.getElementById( 'block-patterns-for-food-bloggers-collection' )
		);
	} );
} );

/**
 * (Experimental) Add support for the pattern category type setting.
 *
 * @param {Array} settings All editor settings
 * @since 0.2.0
 */
// function addCategoryTypeSupport( settings ) {
// 	settings.push( '__experimentalBlockPatternCategoryTypes' );
//
// 	return settings;
// }
// addFilter(
// 	'editor.SupportedEditorSettings',
// 	'block-patterns-for-food-bloggers-collection/add-category-type-support',
// 	addCategoryTypeSupport
// );

/**
 * Add our custom entities for retrieving external data in the Block Editor.
 *
 * @since 0.2.0
 */
dispatch( 'core' ).addEntities( [
	{
		label: __( 'Pattern Category Types', 'block-patterns-for-food-bloggers-collection' ),
		kind: 'block-patterns-for-food-bloggers-collection/v1',
		name: 'patternCategoryTypes',
		baseURL: '/block-patterns-for-food-bloggers-collection/v1/pattern-category-types',
	},
] );
