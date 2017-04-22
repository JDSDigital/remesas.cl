<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the wAdmin files.
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/colors.css',
        'css/colors.min.css',
//        'css/components.css',
        'css/components.min.css',
//        'css/core.css',
        'css/core.min.css',
        'css/icons.css',
//        'css/extras/animate.min.css',
    ];
    public $js = [
//        'js/charts/c3/c3_advanced.js',
//        'js/charts/c3/c3_axis.js',
//        'js/charts/c3/c3_bars_pies.js',
//        'js/charts/c3/c3_grid.js',
//        'js/charts/c3/c3_lines_areas.js',

//        'js/charts/d3/bars/bars_advanced_hierarchical.js',
//        'js/charts/d3/bars/bars_advanced_histogram.js',
//        'js/charts/d3/bars/bars_advanced_simple_interaction.js',
//        'js/charts/d3/bars/bars_advanced_sortable_horizontal.js',
//        'js/charts/d3/bars/bars_advanced_sortable_vertical.js',
//        'js/charts/d3/bars/bars_advanced_sortable_multiple.js',
//        'js/charts/d3/bars/bars_basic_grouped.js',
//        'js/charts/d3/bars/bars_basic_horizontal.js',
//        'js/charts/d3/bars/bars_basic_stacked.js',
//        'js/charts/d3/bars/bars_basic_stacked_normalized.js',
//        'js/charts/d3/bars/bars_basic_tooltip.js',
//        'js/charts/d3/bars/bars_basic_vertical.js',

//        'js/charts/d3/chords/chord_arcs.js',
//        'js/charts/d3/chords/chord_basic.js',
//        'js/charts/d3/chords/chord_chart.js',
//        'js/charts/d3/chords/chord_tweens.js',

//        'js/charts/d3/lines/lines_advanced_difference.js',
//        'js/charts/d3/lines/lines_advanced_missing.js',
//        'js/charts/d3/lines/lines_advanced_small_multiples.js',
//        'js/charts/d3/lines/lines_advanced_spline_transition.js',
//        'js/charts/d3/lines/lines_advanced_transitions.js',
//        'js/charts/d3/lines/lines_advanced_zoom.js',
//        'js/charts/d3/lines/lines_basic.js',
//        'js/charts/d3/lines/lines_basic_area.js',
//        'js/charts/d3/lines/lines_basic_bivariate.js',
//        'js/charts/d3/lines/lines_basic_gradient.js',
//        'js/charts/d3/lines/lines_basic_multi_series.js',
//        'js/charts/d3/lines/lines_basic_stacked.js',
//        'js/charts/d3/lines/lines_basic_stacked_nest.js',

//        'js/charts/d3/other/bubbles.js',
//        'js/charts/d3/other/streamgraph.js',
//        'js/charts/d3/other/treemap.js',
//        'js/charts/d3/other/waterfall.js',

//        'js/charts/d3/pies/donut_arc_tween.js',
//        'js/charts/d3/pies/donut_basic.js',
//        'js/charts/d3/pies/donut_entry_animation.js',
//        'js/charts/d3/pies/donut_multiple.js',
//        'js/charts/d3/pies/donut_multiple_nesting.js',
//        'js/charts/d3/pies/donut_update.js',
//        'js/charts/d3/pies/pie_arc_tween.js',
//        'js/charts/d3/pies/pie_basic.js',
//        'js/charts/d3/pies/pie_entry_animation.js',
//        'js/charts/d3/pies/pie_multiple.js',
//        'js/charts/d3/pies/pie_multiple_nesting.js',
//        'js/charts/d3/pies/pie_update.js',

//        'js/charts/d3/sunburst/sunburst_basic.js',
//        'js/charts/d3/sunburst/sunburst_combined.js',
//        'js/charts/d3/sunburst/sunburst_distortion.js',
//        'js/charts/d3/sunburst/sunburst_zoom.js',

//        'js/charts/d3/tree/tree_basic.js',
//        'js/charts/d3/tree/tree_bracket.js',
//        'js/charts/d3/tree/tree_collapsible.js',
//        'js/charts/d3/tree/tree_dendrogram.js',
//        'js/charts/d3/tree/tree_dendrogram_radial.js',
//        'js/charts/d3/tree/tree_radial.js',

//        'js/charts/d3/venn/venn_basic.js',
//        'js/charts/d3/venn/venn_colors.js',
//        'js/charts/d3/venn/venn_interactive.js',
//        'js/charts/d3/venn/venn_rings.js',
//        'js/charts/d3/venn/venn_tooltip.js',
//        'js/charts/d3/venn/venn_weighted.js',

//        'js/charts/dimple/area/area_horizontal.js',
//        'js/charts/dimple/area/area_horizontal_grouped.js',
//        'js/charts/dimple/area/area_horizontal_stacked.js',
//        'js/charts/dimple/area/area_horizontal_stacked_grouped.js',
//        'js/charts/dimple/area/area_horizontal_stacked_normalized.js',
//        'js/charts/dimple/area/area_vertical.js',
//        'js/charts/dimple/area/area_vertical_grouped.js',
//        'js/charts/dimple/area/area_vertical_stacked.js',
//        'js/charts/dimple/area/area_vertical_stacked_grouped.js',
//        'js/charts/dimple/area/area_vertical_stacked_normalized.js',

//        'js/charts/dimple/bars/bar_horizontal.js',
//        'js/charts/dimple/bars/bar_horizontal_grouped.js',
//        'js/charts/dimple/bars/bar_horizontal_stacked.js',
//        'js/charts/dimple/bars/bar_horizontal_stacked_grouped.js',
//        'js/charts/dimple/bars/bar_horizontal_stacked_normalized.js',
//        'js/charts/dimple/bars/bar_vertical.js',
//        'js/charts/dimple/bars/bar_vertical_grouped.js',
//        'js/charts/dimple/bars/bar_vertical_stacked.js',
//        'js/charts/dimple/bars/bar_vertical_stacked_grouped.js',
//        'js/charts/dimple/bars/bar_vertical_stacked_normalized.js',

//        'js/charts/dimple/bubble/bubble_basic.js',
//        'js/charts/dimple/bubble/bubble_horizontal_lollipop.js',
//        'js/charts/dimple/bubble/bubble_lollipop_grouped.js',
//        'js/charts/dimple/bubble/bubble_matrix.js',
//        'js/charts/dimple/bubble/bubble_vertical_lollipop.js',

//        'js/charts/dimple/lines/line_horizontal_multiple.js',
//        'js/charts/dimple/lines/line_horizontal_multiple_grouped.js',
//        'js/charts/dimple/lines/line_horizontal_single.js',
//        'js/charts/dimple/lines/line_horizontal_single_grouped.js',
//        'js/charts/dimple/lines/line_vertical_multiple.js',
//        'js/charts/dimple/lines/line_vertical_multiple_grouped.js',
//        'js/charts/dimple/lines/line_vertical_single.js',
//        'js/charts/dimple/lines/line_vertical_single_grouped.js',

//        'js/charts/dimple/pies/pie_basic.js',
//        'js/charts/dimple/pies/pie_bubble.js',
//        'js/charts/dimple/pies/pie_legend.js',
//        'js/charts/dimple/pies/pie_lollipop.js',
//        'js/charts/dimple/pies/pie_matrix.js',
//        'js/charts/dimple/pies/pie_scatter.js',

//        'js/charts/dimple/rings/ring_basic.js',
//        'js/charts/dimple/rings/ring_bubble.js',
//        'js/charts/dimple/rings/ring_concentric.js',
//        'js/charts/dimple/rings/ring_lollipop.js',
//        'js/charts/dimple/rings/ring_matrix.js',
//        'js/charts/dimple/rings/ring_scatter.js',

//        'js/charts/dimple/scatter/scatter_basic.js',
//        'js/charts/dimple/scatter/scatter_horizontal_lollipop.js',
//        'js/charts/dimple/scatter/scatter_lollipop_grouped.js',
//        'js/charts/dimple/scatter/scatter_matrix.js',
//        'js/charts/dimple/scatter/scatter_vertical_lollipop.js',

//        'js/charts/dimple/step/step_horizontal_multiple.js',
//        'js/charts/dimple/step/step_horizontal_multiple_grouped.js',
//        'js/charts/dimple/step/step_horizontal_single.js',
//        'js/charts/dimple/step/step_horizontal_single_grouped.js',
//        'js/charts/dimple/step/step_vertical_multiple.js',
//        'js/charts/dimple/step/step_vertical_multiple_grouped.js',
//        'js/charts/dimple/step/step_vertical_single.js',
//        'js/charts/dimple/step/step_vertical_single_grouped.js',

//        'js/charts/echarts/bars_tornados.js',
//        'js/charts/echarts/candlesticks_others.js',
//        'js/charts/echarts/columns_waterfalls.js',
//        'js/charts/echarts/combinations.js',
//        'js/charts/echarts/funnels_chords.js',
//        'js/charts/echarts/lines_areas.js',
//        'js/charts/echarts/pies_donuts.js',
//        'js/charts/echarts/scatter.js',
//        'js/charts/echarts/timeline_option.js',

//        'js/charts/google/bars/bar.js',
//        'js/charts/google/bars/bar_stacked.js',
//        'js/charts/google/bars/column.js',
//        'js/charts/google/bars/column_stacked.js',
//        'js/charts/google/bars/combo.js',
//        'js/charts/google/bars/histogram.js',

//        'js/charts/google/bubbles/bubble.js',
//        'js/charts/google/bubbles/bubble_gradient.js',
//
//        'js/charts/google/lines/area.js',
//        'js/charts/google/lines/area_intervals.js',
//        'js/charts/google/lines/area_stacked.js',
//        'js/charts/google/lines/area_stepped.js',
//        'js/charts/google/lines/lines.js',
//        'js/charts/google/lines/line_intervals.js',

//        'js/charts/google/other/candlestick.js',
//        'js/charts/google/other/diff.js',
//        'js/charts/google/other/geo.js',
//        'js/charts/google/other/sankey.js',
//        'js/charts/google/other/trendline.js',

//        'js/charts/google/pies/3d_exploded.js',
//        'js/charts/google/pies/donut.js',
//        'js/charts/google/pies/donut_exploded.js',
//        'js/charts/google/pies/donut_rotate.js',
//        'js/charts/google/pies/pie.js',
//        'js/charts/google/pies/pie_3d.js',
//        'js/charts/google/pies/pie_diff_border.js',
//        'js/charts/google/pies/pie_diff_invert.js',
//        'js/charts/google/pies/pie_diff_opacity.js',
//        'js/charts/google/pies/pie_diff_radius.js',
//        'js/charts/google/pies/pie_exploded.js',
//        'js/charts/google/pies/pie_rotate.js',

//        'js/charts/google/scatter/scatter.js',
//        'js/charts/google/scatter/scatter_diff.js',

        'js/core/app.js',

/**
 *  AQUI FALTAN EL JQUERY UI
 */

//        'js/maps/google/basic/basic.js',
//        'js/maps/google/basic/click_event.js',
//        'js/maps/google/basic/coordinates.js',
//        'js/maps/google/basic/geolocation.js',

//        'js/maps/google/controls/adding_controls.js',
//        'js/maps/google/controls/control_options.js',
//        'js/maps/google/controls/control_positioning.js',
//        'js/maps/google/controls/disable_ui.js',

//        'js/maps/google/drawings/circles.js',
//        'js/maps/google/drawings/polygons.js',
//        'js/maps/google/drawings/polylines.js',
//        'js/maps/google/drawings/rectangles.js',

//        'js/maps/google/layers/bicycling.js',
//        'js/maps/google/layers/fusion_tables.js',
//        'js/maps/google/layers/traffic.js',
//        'js/maps/google/layers/transit.js',

//        'js/maps/google/markers/animation.js',
//        'js/maps/google/markers/simple.js',
//        'js/maps/google/markers/symbols_custom.js',
//        'js/maps/google/markers/symbols_predefined.js',

//        'js/maps/vector/vector_maps_demo.js',

//        'js/pages/appearance_draggable_panels.js',
//        'js/pages/appearance_panel_heading.js',
//        'js/pages/colors_blue.js',
//        'js/pages/colors_brown.js',
//        'js/pages/colors_danger.js',
//        'js/pages/colors_green.js',
//        'js/pages/colors_grey.js',
//        'js/pages/colors_indigo.js',
//        'js/pages/colors_info.js',
//        'js/pages/colors_orange.js',
//        'js/pages/colors_pink.js',
//        'js/pages/colors_primary.js',
//        'js/pages/colors_purple.js',
//        'js/pages/colors_slate.js',
//        'js/pages/colors_success.js',
//        'js/pages/colors_teal.js',
//        'js/pages/colors_violet.js',
//        'js/pages/colors_warning.js',
//        'js/pages/components_animations.js',
//        'js/pages/components_buttons.js',
//        'js/pages/components_dropdowns.js',
//        'js/pages/components_loaders.js',
//        'js/pages/components_media.js',
//        'js/pages/components_modals.js',
//        'js/pages/components_navs.js',
//        'js/pages/components_notifications_other.js',
//        'js/pages/components_notifications_pnotify.js',
//        'js/pages/components_page_header.js',
//        'js/pages/components_pagination.js',
//        'js/pages/components_popups.js',
//        'js/pages/components_sliders.js',
//        'js/pages/components_thumbnails.js',
//        'js/pages/dashboard.js',
//        'js/pages/dashboard_boxed.js',
//        'js/pages/dashboard_boxed_full.js',
//        'js/pages/datatables_advanced.js',
//        'js/pages/datatables_api.js',
//        'js/pages/datatables_basic.js',
//        'js/pages/datatables_data_sources.js',
//        'js/pages/datatables_extension_colvis.js',
//        'js/pages/datatables_extension_fixed_columns.js',
//        'js/pages/datatables_extension_reorder.js',
//        'js/pages/datatables_extension_scroller.js',
//        'js/pages/datatables_extension_tools.js',
//        'js/pages/datatables_responsive.js',
//        'js/pages/datatables_sorting.js',
//        'js/pages/editor_ckeditor.js',
//        'js/pages/editor_code.js',
//        'js/pages/editor_summernote.js',
//        'js/pages/editor_wysihtml5.js',
//        'js/pages/extension_blockui.js',
//        'js/pages/extension_image_cropper.js',
//        'js/pages/extension_velocity_basic.js',
//        'js/pages/extension_velocity_examples.js',
//        'js/pages/extension_velocity_ui.js',
//        'js/pages/extra_context_menu.js',
//        'js/pages/extra_fullcalendar.js',
//        'js/pages/extra_fullcalendar_advanced.js',
//        'js/pages/extra_fullcalendar_formats.js',
//        'js/pages/extra_idle_timeout.js',
//        'js/pages/extra_session_timeout.js',
//        'js/pages/extra_trees.js',
//        'js/pages/form_bootstrap_select.js',
//        'js/pages/form_checkboxes_radios.js',
//        'js/pages/form_controls_extended.js',
//        'js/pages/form_dual_listboxes.js',
//        'js/pages/form_editable.js',
//        'js/pages/form_inputs.js',
//        'js/pages/form_input_groups.js',
//        'js/pages/form_layouts.js',
//        'js/pages/form_multiselect.js',
//        'js/pages/form_select2.js',
//        'js/pages/form_selectbox.js',
//        'js/pages/form_tags_input.js',
//        'js/pages/form_validation.js',
//        'js/pages/gallery.js',
//        'js/pages/gallery_library.js',
//        'js/pages/internationalization_callbacks.js',
//        'js/pages/internationalization_fallback.js',
//        'js/pages/internationalization_on_init.js',
//        'js/pages/internationalization_switch_direct.js',
//        'js/pages/internationalization_switch_query.js',
//        'js/pages/invoice_archive.js',
//        'js/pages/invoice_grid.js',
//        'js/pages/invoice_template.js',
//        'js/pages/layout_fixed_custom.js',
//        'js/pages/layout_fixed_native.js',
//        'js/pages/layout_navbar_hideable.js',
//        'js/pages/layout_navbar_hideable_sidebar.js',
//        'js/pages/login.js',
//        'js/pages/navbar_components.js',
//        'js/pages/navbar_hideable.js',
//        'js/pages/navbar_multiple.js',
//        'js/pages/navbar_single.js',
//        'js/pages/navigation_horizontal_elements.js',
//        'js/pages/navigation_horizontal_mega.js',
//        'js/pages/navigation_vertical_sizing.js',
//        'js/pages/picker_color.js',
//        'js/pages/picker_date.js',
//        'js/pages/picker_location.js',
//        'js/pages/sidebar_components.js',
//        'js/pages/sidebar_detached_sticky_custom.js',
//        'js/pages/sidebar_detached_sticky_native.js',
//        'js/pages/sidebar_dual.js',
//        'js/pages/support_chat_layouts.js',
//        'js/pages/table_elements.js',
//        'js/pages/table_responsive.js',
//        'js/pages/tasks_grid.js',
//        'js/pages/tasks_list.js',
//        'js/pages/task_detailed.js',
//        'js/pages/timelines.js',
//        'js/pages/uploader_bootstrap.js',
//        'js/pages/uploader_dropzone.js',
//        'js/pages/uploader_plupload.js',
//        'js/pages/user_pages_list.js',
//        'js/pages/user_pages_profile.js',
//        'js/pages/user_pages_team.js',
//        'js/pages/wizard_form.js',
//        'js/pages/wizard_steps.js',
//        'js/pages/wizard_stepy.js',

//        'js/plugins/buttons/hover_dropdown.min.js',
//        'js/plugins/buttons/ladda.min.js',
//        'js/plugins/buttons/spin.min.js',

//        'js/plugins/extensions/contextmenu.js',
//        'js/plugins/extensions/cookie.js',
//        'js/plugins/extensions/mockjax.min.js',
//        'js/plugins/extensions/session_timeout.min.js',

//        'js/plugins/forms/editable',
//        'js/plugins/forms/editable/address.js',
//        'js/plugins/forms/editable/editable.min.js',
//        'js/plugins/forms/editable/wysihtml5.js',

//        'js/plugins/forms/inputs/autosize.min.js',
//        'js/plugins/forms/inputs/duallistbox.min.js',
//        'js/plugins/forms/inputs/formatter.min.js',
//        'js/plugins/forms/inputs/maxlength.min.js',
//        'js/plugins/forms/inputs/passy.js',
//        'js/plugins/forms/inputs/touchspin.min.js',

//        'js/plugins/forms/inputs/typeahead/handlebars.js',
//        'js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js',

//        'js/plugins/forms/selects/bootstrap_multiselect.js',
//        'js/plugins/forms/selects/bootstrap_select.min.js',
//        'js/plugins/forms/selects/select2.min.js',
//        'js/plugins/forms/selects/selectboxit.min.js',

        'js/plugins/forms/styling/switch.min.js',
        'js/plugins/forms/styling/switchery.min.js',
//        'js/plugins/forms/styling/uniform.min.js',

//        'js/plugins/forms/tags/tagsinput.min.js',
//        'js/plugins/forms/tags/tokenfield.min.js',

//        'js/plugins/forms/validation/additional_methods.min.js',

//        'js/plugins/forms/validation/localization/messages_ar.js',
//        'js/plugins/forms/validation/localization/messages_ar.min.js',
//        'js/plugins/forms/validation/localization/messages_bg.js',
//        'js/plugins/forms/validation/localization/messages_bg.min.js',
//        'js/plugins/forms/validation/localization/messages_ca.js',
//        'js/plugins/forms/validation/localization/messages_ca.min.js',
//        'js/plugins/forms/validation/localization/messages_cs.js',
//        'js/plugins/forms/validation/localization/messages_cs.min.js',
//        'js/plugins/forms/validation/localization/messages_da.js',
//        'js/plugins/forms/validation/localization/messages_da.min.js',
//        'js/plugins/forms/validation/localization/messages_de.js',
//        'js/plugins/forms/validation/localization/messages_de.min.js',
//        'js/plugins/forms/validation/localization/messages_el.js',
//        'js/plugins/forms/validation/localization/messages_el.min.js',
//        'js/plugins/forms/validation/localization/messages_es.js',
//        'js/plugins/forms/validation/localization/messages_es.min.js',
//        'js/plugins/forms/validation/localization/messages_es_AR.js',
//        'js/plugins/forms/validation/localization/messages_es_AR.min.js',
//        'js/plugins/forms/validation/localization/messages_et.js',
//        'js/plugins/forms/validation/localization/messages_et.min.js',
//        'js/plugins/forms/validation/localization/messages_eu.js',
//        'js/plugins/forms/validation/localization/messages_eu.min.js',
//        'js/plugins/forms/validation/localization/messages_fa.js',
//        'js/plugins/forms/validation/localization/messages_fa.min.js',
//        'js/plugins/forms/validation/localization/messages_fi.js',
//        'js/plugins/forms/validation/localization/messages_fi.min.js',
//        'js/plugins/forms/validation/localization/messages_fr.js',
//        'js/plugins/forms/validation/localization/messages_fr.min.js',
//        'js/plugins/forms/validation/localization/messages_gl.js',
//        'js/plugins/forms/validation/localization/messages_gl.min.js',
//        'js/plugins/forms/validation/localization/messages_he.js',
//        'js/plugins/forms/validation/localization/messages_he.min.js',
//        'js/plugins/forms/validation/localization/messages_hr.js',
//        'js/plugins/forms/validation/localization/messages_hr.min.js',
//        'js/plugins/forms/validation/localization/messages_hu.js',
//        'js/plugins/forms/validation/localization/messages_hu.min.js',
//        'js/plugins/forms/validation/localization/messages_id.js',
//        'js/plugins/forms/validation/localization/messages_id.min.js',
//        'js/plugins/forms/validation/localization/messages_is.js',
//        'js/plugins/forms/validation/localization/messages_is.min.js',
//        'js/plugins/forms/validation/localization/messages_it.js',
//        'js/plugins/forms/validation/localization/messages_it.min.js',
//        'js/plugins/forms/validation/localization/messages_ja.js',
//        'js/plugins/forms/validation/localization/messages_ja.min.js',
//        'js/plugins/forms/validation/localization/messages_ka.js',
//        'js/plugins/forms/validation/localization/messages_ka.min.js',
//        'js/plugins/forms/validation/localization/messages_kk.js',
//        'js/plugins/forms/validation/localization/messages_kk.min.js',
//        'js/plugins/forms/validation/localization/messages_ko.js',
//        'js/plugins/forms/validation/localization/messages_ko.min.js',
//        'js/plugins/forms/validation/localization/messages_lt.js',
//        'js/plugins/forms/validation/localization/messages_lt.min.js',
//        'js/plugins/forms/validation/localization/messages_lv.js',
//        'js/plugins/forms/validation/localization/messages_lv.min.js',
//        'js/plugins/forms/validation/localization/messages_my.js',
//        'js/plugins/forms/validation/localization/messages_my.min.js',
//        'js/plugins/forms/validation/localization/messages_nl.js',
//        'js/plugins/forms/validation/localization/messages_nl.min.js',
//        'js/plugins/forms/validation/localization/messages_no.js',
//        'js/plugins/forms/validation/localization/messages_no.min.js',
//        'js/plugins/forms/validation/localization/messages_pl.js',
//        'js/plugins/forms/validation/localization/messages_pl.min.js',
//        'js/plugins/forms/validation/localization/messages_pt_BR.js',
//        'js/plugins/forms/validation/localization/messages_pt_BR.min.js',
//        'js/plugins/forms/validation/localization/messages_pt_PT.js',
//        'js/plugins/forms/validation/localization/messages_pt_PT.min.js',
//        'js/plugins/forms/validation/localization/messages_ro.js',
//        'js/plugins/forms/validation/localization/messages_ro.min.js',
//        'js/plugins/forms/validation/localization/messages_ru.js',
//        'js/plugins/forms/validation/localization/messages_ru.min.js',
//        'js/plugins/forms/validation/localization/messages_si.js',
//        'js/plugins/forms/validation/localization/messages_si.min.js',
//        'js/plugins/forms/validation/localization/messages_sk.js',
//        'js/plugins/forms/validation/localization/messages_sk.min.js',
//        'js/plugins/forms/validation/localization/messages_sl.js',
//        'js/plugins/forms/validation/localization/messages_sl.min.js',
//        'js/plugins/forms/validation/localization/messages_sr.js',
//        'js/plugins/forms/validation/localization/messages_sr.min.js',
//        'js/plugins/forms/validation/localization/messages_sr_lat.js',
//        'js/plugins/forms/validation/localization/messages_sr_lat.min.js',
//        'js/plugins/forms/validation/localization/messages_sv.js',
//        'js/plugins/forms/validation/localization/messages_sv.min.js',
//        'js/plugins/forms/validation/localization/messages_th.js',
//        'js/plugins/forms/validation/localization/messages_th.min.js',
//        'js/plugins/forms/validation/localization/messages_tj.js',
//        'js/plugins/forms/validation/localization/messages_tj.min.js',
//        'js/plugins/forms/validation/localization/messages_tr.js',
//        'js/plugins/forms/validation/localization/messages_tr.min.js',
//        'js/plugins/forms/validation/localization/messages_uk.js',
//        'js/plugins/forms/validation/localization/messages_uk.min.js',
//        'js/plugins/forms/validation/localization/messages_vi.js',
//        'js/plugins/forms/validation/localization/messages_vi.min.js',
//        'js/plugins/forms/validation/localization/messages_zh.js',
//        'js/plugins/forms/validation/localization/messages_zh.min.js',
//        'js/plugins/forms/validation/localization/messages_zh_TW.js',
//        'js/plugins/forms/validation/localization/messages_zh_TW.min.js',
//        'js/plugins/forms/validation/localization/methods_de.js',
//        'js/plugins/forms/validation/localization/methods_de.min.js',
//        'js/plugins/forms/validation/localization/methods_es_CL.js',
//        'js/plugins/forms/validation/localization/methods_es_CL.min.js',
//        'js/plugins/forms/validation/localization/methods_fi.js',
//        'js/plugins/forms/validation/localization/methods_fi.min.js',
//        'js/plugins/forms/validation/localization/methods_nl.js',
//        'js/plugins/forms/validation/localization/methods_nl.min.js',
//        'js/plugins/forms/validation/localization/methods_pt.js',
//        'js/plugins/forms/validation/localization/methods_pt.min.js',

//        'js/plugins/forms/validation/validate.min.js',

//        'js/plugins/forms/wizards/form_wizard/form.min.js',
//        'js/plugins/forms/wizards/form_wizard/form_wizard.min.js',
//        'js/plugins/forms/wizards/steps.min.js',
//        'js/plugins/forms/wizards/stepy.min.js',

//        'js/plugins/internationalization/i18next.min.js',

//        'js/plugins/loaders/blockui.min.js',
//        'js/plugins/loaders/pace.min.js',
//        'js/plugins/loaders/progressbar.min.js',

//        'js/plugins/maps/jvectormap/jvectormap.min.js',

//        'js/plugins/maps/jvectormap/map_files/countries/argentina.js',
//        'js/plugins/maps/jvectormap/map_files/countries/australia.js',
//        'js/plugins/maps/jvectormap/map_files/countries/austria.js',
//        'js/plugins/maps/jvectormap/map_files/countries/belgium.js',
//        'js/plugins/maps/jvectormap/map_files/countries/canada.js',
//        'js/plugins/maps/jvectormap/map_files/countries/china.js',
//        'js/plugins/maps/jvectormap/map_files/countries/colombia.js',
//        'js/plugins/maps/jvectormap/map_files/countries/denmark.js',
//        'js/plugins/maps/jvectormap/map_files/countries/france.js',
//        'js/plugins/maps/jvectormap/map_files/countries/germany.js',
//        'js/plugins/maps/jvectormap/map_files/countries/india.js',
//        'js/plugins/maps/jvectormap/map_files/countries/italy.js',
//        'js/plugins/maps/jvectormap/map_files/countries/netherlands.js',
//        'js/plugins/maps/jvectormap/map_files/countries/new_zealand.js',
//        'js/plugins/maps/jvectormap/map_files/countries/norway.js',
//        'js/plugins/maps/jvectormap/map_files/countries/philippines.js',
//        'js/plugins/maps/jvectormap/map_files/countries/poland.js',
//        'js/plugins/maps/jvectormap/map_files/countries/portugal.js',
//        'js/plugins/maps/jvectormap/map_files/countries/south_africa.js',
//        'js/plugins/maps/jvectormap/map_files/countries/spain.js',
//        'js/plugins/maps/jvectormap/map_files/countries/sweden.js',
//        'js/plugins/maps/jvectormap/map_files/countries/switzerland.js',
//        'js/plugins/maps/jvectormap/map_files/countries/thailand.js',
//        'js/plugins/maps/jvectormap/map_files/countries/thailand_regions.js',
//        'js/plugins/maps/jvectormap/map_files/countries/uk.js',
//        'js/plugins/maps/jvectormap/map_files/europe.js',
//        'js/plugins/maps/jvectormap/map_files/world.js',
    ];
}
