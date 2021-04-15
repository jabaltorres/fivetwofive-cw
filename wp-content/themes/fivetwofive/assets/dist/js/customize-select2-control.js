/**
 * Script for our custom select2 control.
 */
wp.customize.controlConstructor['fivetwofive-select2'] = wp.customize.Control.extend( {
    ready: function() {
        var control = this;
        wp.customize.Control.prototype.ready.call( control );
        this.container.find( '.js-customize-control-fivetwofive-select2' ).select2();
    }
} );