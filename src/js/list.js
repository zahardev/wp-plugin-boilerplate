/**
 * Handles the messages list
 *
 * @package WP_Plugin_Boilerplate
 * */

import UrlHelper from "./url-helper";

const $ = jQuery;

/**
 * Class Form
 * */
class List {
	constructor() {
		document.addEventListener( "DOMContentLoaded", () => {
			this.data       = boilerplateData;
			this.$container = $( '.js-example-list' );
			if ( ! this.$container.length ) {
				return;
			}
			this.initProperties();
			this.initPagination();
			this.fetchList( this.$pagination.data( 'page' ) );
			this.urlHelper = new UrlHelper();
		} );
	}

	initProperties() {
		this.$listContainer    = this.$container.find( '.js-list-container' );
		this.$pagination 	     = this.$container.find( '.js-pagination' );
		this.$listItemTmpl     = this.$container.find( '.js-list-item-tmpl' );
		this.$msg              = this.$container.find( '.js-msg' );
		this.$detailsContainer = this.$container.find( '.js-details-container' );
		this.$detailsTmpl      = this.$container.find( '.js-details-tmpl' );
	}

	validatePageNumber( pageNumber ) {
		return pageNumber > 0 && pageNumber <= this.$pagination.data( 'last-page' ) && pageNumber !== this.$pagination.data( 'page' );
	}

	initPagination() {
		this.listenPaginationBtns();
		this.listenUrlChange();
	}

	listenUrlChange() {
		window.onpopstate = () => {
			const page = this.urlHelper.getUrlParameter( window.location.href, 'pag' );
			this.fetchList( page );
		};
	}

	syncPaginationBtns( page, lastPage ) {
		this.$pagination.data( 'page', page )
		this.enablePaginationBtns();

		if ( 1 === page ) {
			this.disablePaginationBtn( this.$pagination.find( '.js-first' ) );
			this.disablePaginationBtn( this.$pagination.find( '.js-prev' ) );
		}

		if ( page === lastPage ) {
			this.disablePaginationBtn( this.$pagination.find( '.js-next' ) );
			this.disablePaginationBtn( this.$pagination.find( '.js-last' ) );
		}
	}

	disablePaginationBtn( $btn ) {
		$btn.addClass( 'disabled js-disabled' );
	}

	enablePaginationBtns() {
		this.$pagination.find( 'button' ).removeClass( 'disabled js-disabled' );
	}

	listenPaginationBtns() {
		this.$pagination.find( '.js-first' ).click( ( e ) => {
			if ( ! $( e.currentTarget ).hasClass( 'js-disabled' ) && this.validatePageNumber( 1 ) ) {
				this.fetchList( 1 );
			}
		} );

		this.$pagination.find( '.js-prev' ).click( ( e ) => {
			const page = this.$pagination.data( 'page' ) - 1;
			if ( ! $( e.currentTarget ).hasClass( 'js-disabled' ) && this.validatePageNumber( page ) ) {
				this.fetchList( page );
			}
		} );

		this.$pagination.find( '.js-next' ).click( ( e ) => {
			const page = this.$pagination.data( 'page' ) + 1;
			if ( ! $( e.currentTarget ).hasClass( 'js-disabled' ) && this.validatePageNumber( page ) ) {
				this.fetchList( page );
			}
		} );

		this.$pagination.find( '.js-last' ).not( '.disabled' ).click( ( e ) => {
			const page = this.$pagination.data( 'last-page' );
			if ( ! $( e.currentTarget ).hasClass( 'js-disabled' ) && this.validatePageNumber( page ) ) {
				this.fetchList( page );
			}
		} );
	}

	fetchList( page ) {
		// If another request was sent already, do nothing.
		if ( this.$listContainer.hasClass( 'loader' ) ) {
			return;
		}

		const data = {
			action: 'get_example_list',
			page: page,
			nonce: this.data.getListNonce
		};

		this.$listContainer.addClass( 'loader' );

		$.get( this.data.ajaxUrl, data, ( res ) => {
			this.$listContainer.removeClass( 'loader' );
			this.$listContainer.find( '.js-list-item' ).remove();
			if ( true === res.success ) {
				let url = window.location.href;
				if ( page > 1 ) {
					url = this.urlHelper.updateURLParameter( url, 'pag', page );
				} else {
					url = this.urlHelper.removeUrlParameter( url, 'pag' );
				}

				if ( url !== window.location.href ) {
					window.history.pushState( {}, null, url );
				}

				if ( 'msg' in res.data ) {
					this.$msg.removeClass( 'error' ).html( res.data.msg );
				}

				if ( 'items' in res.data ) {
					this.renderListItems( res.data.items )
				}

				if ( res.data.pages > 1 ) {
					this.$pagination.show().find( '.js-pages-info' ).html( res.data.pagesInfo );
					this.syncPaginationBtns( page, res.data.pages );
				}
			} else {
				this.$msg.addClass( 'error' );
				this.$msg.html( res.data );
			}
		} );
	}

	renderListItems( items ) {
		this.$listContainer.show();
		items.forEach( ( data ) => {
			let $listItem = this.$listItemTmpl.clone();
			$listItem.removeClass( 'js-list-item-tmpl' ).addClass( 'js-list-item' ).show();
			$.each(
				this.getElementClasses(),
				function( property, elClass ) {
					let $el = $listItem.find( '.' + elClass );
					$el.html( data[ property ] ).attr( 'title', data[ property ] );
				}
			);
			this.$listContainer.append( $listItem );
			$listItem.data( 'id', data.id );
		} );
	}

	renderDetails( data ) {
		let $details = this.$detailsTmpl.clone();
		$details.removeClass( 'js-details-tmpl' ).addClass( 'js-details' ).show();

		$.each(
			this.getElementClasses(),
			( property, elClass ) => {
				let $container = $details.find( '.' + elClass ),
					 $el        = $( '<p></p>' );
				$el.html( data[ property ] ).attr( 'title', data[ property ] ).appendTo( $container );
			}
		);

		this.$detailsContainer.find( '.js-details' ).remove(); // Remove the old details.
		this.$detailsContainer.append( $details );
		$details.data( 'id', data.id );
	}

	getElementClasses() {
		return {
			name: 'js-name',
			date: 'js-date',
		};
	}
}

export default List;
