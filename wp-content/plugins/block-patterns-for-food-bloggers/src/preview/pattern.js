/**
 * WordPress dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import {
	Button,
	__unstableCompositeItem as CompositeItem, // eslint-disable-line
	VisuallyHidden,
} from '@wordpress/components';
import { BlockPreview } from '@wordpress/block-editor';
import { cloneBlock } from '@wordpress/blocks';
import { useInstanceId } from '@wordpress/compose';
import { useDispatch, dispatch } from '@wordpress/data';

/**
 * Renders the block pattern 'card'.
 *
 * @since 0.1.0
 * @param {Object} props All the props passed to this function
 * @return {string}      Return the rendered JSX
 */
export default function Pattern( props ) {
	const {
		pattern,
		onInsertPattern,
		viewportWidth,
		composite,
		isBlock,
		clientId,
	} = props;
	const { title, categories = [], blocks } = pattern; // eslint-disable-line
	const { createSuccessNotice } = useDispatch( 'core/notices' );
	const instanceId = useInstanceId( Pattern );
	const descriptionId = `preview-pattern-card__info-description-${ instanceId }`;

	function insertPattern() {
		onInsertPattern( blocks.map( ( block ) => cloneBlock( block ) ) );

		// If the inserter was rendered from a block, we need to remove that
		// original block.
		if ( isBlock ) {
			dispatch( 'core/block-editor' ).removeBlock( clientId );
		}

		// Trigger click event on close button of the modal
		const closeButton = document.querySelector('.block-patterns-for-food-bloggers-collection__modal .components-modal__header button');
		if ( closeButton ) {
			closeButton.click();
		}

		createSuccessNotice(
			sprintf(
				// Translators: Name of the pattern being inserted.
				__( 'Block pattern "%s" inserted.', 'block-patterns-for-food-bloggers' ),
				pattern.title
			),
			{ type: 'snackbar' }
		);
	}

	const baseClassName = 'block-patterns-for-food-bloggers__preview-pattern-list__item';

	return (
		<div
			className={ baseClassName }
			aria-label={ pattern.title }
			aria-describedby={
				pattern?.description ? descriptionId : undefined
			}
		>
			<CompositeItem
				role="option"
				as="div"
				{ ...composite }
				className={ `${ baseClassName }-preview` }
				onClick={ insertPattern }
			>
				<BlockPreview
					blocks={ blocks }
					viewportWidth={ viewportWidth }
				/>
			</CompositeItem>
			<div className={ `${ baseClassName }-actions` }>
				<div className={ `${ baseClassName }-title` }>{ title }</div>
				{ !! pattern.description && (
					<VisuallyHidden id={ descriptionId }>
						{ pattern.description }
					</VisuallyHidden>
				) }
				<Button isSecondary onClick={ insertPattern }>
					{ __( 'Add Pattern', 'block-patterns-for-food-bloggers' ) }
				</Button>
			</div>
		</div>
	);
}
