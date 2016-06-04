var http_reffer = '';
var addons_html = '';
jQuery(document).ready(function () {


    if (jQuery('div.wc_ps_addon_listing').size() > 0) {
        jQuery('p.submit').remove();
    }

    if (jQuery('.wc_ps_settings_submenu').size() > 0) {
        var id = window.location.hash;
        jQuery('.wc_ps_settings_submenu a').removeClass('current');
        jQuery('.wc_ps_settings_submenu a[href="' + id + '" ]').addClass('current');
        if (id == '') {
            jQuery('.wc_ps_settings_submenu a:first').addClass('current');
            id = jQuery('.wc_ps_settings_submenu a:first').attr('href');
        }
        http_reffer = jQuery('input[name=_wp_http_referer').val();

        settings_showHash(id);
    }

    jQuery('.wc_ps_settings_submenu a').click(function () {
        var id = jQuery(this).attr('href');
        jQuery('.wc_ps_settings_submenu a').removeClass('current');
        jQuery(this).addClass('current');
        settings_showHash(id);
        jQuery('input[name=_wp_http_referer').val(http_reffer + id)
    });

});

function settings_showHash(id) {
    jQuery('div.wc_ps_settings_content').hide();
    id = id.replace('#', '#settings_');
    jQuery(id).show();
}