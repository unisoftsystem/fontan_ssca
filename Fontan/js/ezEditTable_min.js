/*------------------------------------------------------------------------ 
 - ezEditTable v2.3 by Max Guglielmi 
 - build date: Sun Mar 15 2015 14:35:06 
 - http://edittable.free.fr 
 - Copyright (c) 2012, License required for use 
 ------------------------------------------------------------------------*/
function setEditTable() {
    if (0 !== arguments.length) {
        var a = new EditTable(arguments[0], arguments[1], arguments[2]);
        return a.Init(), a
    }
}
var EditTable = function(a) {
    if (0 !== arguments.length && (this.id = a, this.version = "2.3", this.table = this.Get(a), this.tBody = this.table.tBodies[0], this.startRow = 0, this.config = null, this.nbCells = null, window.et_activeGrid || (window.et_activeGrid = ""), null !== this.table && "table" === this.table.nodeName.LCase())) {
        var b = this.Tag(this.tBody, "tr");
        if (b.length > 0 && (this.startRow = b[0].rowIndex), arguments.length > 1)
            for (var c = 0; c < arguments.length; c++) {
                var d = typeof arguments[c];
                "number" === d.LCase() && (this.startRow = arguments[c]), "object" === d.LCase() && (this.config = arguments[c])
            }
        this.nbCells = this.GetCellsNb(this.startRow);
        var e = this.config || {};
        this.selection = e.selection === !1 ? !1 : !0, this.keyNav = void 0 !== e.key_navigation ? e.key_navigation : !0, this.editable = void 0 !== e.editable ? e.editable : !1, this.tableCss = void 0 !== e.table_css ? e.table_css : "ezEditableTable", this.unselectableCss = void 0 !== e.unselectable_css ? e.unselectable_css : "ezUnselectable", this.basePath = void 0 !== e.base_path ? e.base_path : "ezEditTable/", this.activityIndicatorCss = void 0 !== e.activity_indicator_css ? e.activity_indicator_css : "ezOpacity", this.onServerActivityStart = this.IsFn(e.on_server_activity_start) ? e.on_server_activity_start : null, this.onServerActivityStop = this.IsFn(e.on_server_activity_stop) ? e.on_server_activity_stop : null, this.selectionModel = void 0 !== e.selection_model ? e.selection_model.LCase() : "single", this.defaultSelection = void 0 !== e.default_selection ? e.default_selection.LCase() : "row", this.keySelection = this.editable ? !0 : void 0 !== e.key_selection ? e.key_selection : !0, this.selectRowAtStart = void 0 !== e.select_row_at_start ? e.select_row_at_start : !1, this.rowIndexAtStart = void 0 !== e.row_index_at_start ? parseInt(e.row_index_at_start, 10) : this.startRow, this.scrollIntoView = void 0 !== e.scroll_into_view ? e.scroll_into_view : !1, this.activeRowCss = void 0 !== e.active_row_css ? e.active_row_css : "ezActiveRow", this.selectedRowCss = void 0 !== e.selected_row_css ? e.selected_row_css : "ezSelectedRow", this.activeCellCss = void 0 !== e.active_cell_css ? e.active_cell_css : "ezActiveCell", this.nbRowsPerPage = void 0 !== e.nb_rows_per_page ? e.nb_rows_per_page : 10, this.onSelectionInit = this.IsFn(e.on_selection_initialized) ? e.on_selection_initialized : null, this.onBeforeSelectedRow = this.IsFn(e.on_before_selected_row) ? e.on_before_selected_row : null, this.onAfterSelectedRow = this.IsFn(e.on_after_selected_row) ? e.on_after_selected_row : null, this.onBeforeSelectedCell = this.IsFn(e.on_before_selected_cell) ? e.on_before_selected_cell : null, this.onAfterSelectedCell = this.IsFn(e.on_after_selected_cell) ? e.on_after_selected_cell : null, this.onBeforeDeselectedRow = this.IsFn(e.on_before_deselected_row) ? e.on_before_deselected_row : null, this.onAfterDeselectedRow = this.IsFn(e.on_after_deselected_row) ? e.on_after_deselected_row : null, this.onBeforeDeselectedCell = this.IsFn(e.on_before_deselected_cell) ? e.on_before_deselected_cell : null, this.onAfterDeselectedCell = this.IsFn(e.on_after_deselected_cell) ? e.on_after_deselected_cell : null, this.onValidateRow = this.IsFn(e.on_validate_row) ? e.on_validate_row : null, this.onValidateCell = this.IsFn(e.on_validate_cell) ? e.on_validate_cell : null, this.editorModel = void 0 !== e.editor_model ? e.editor_model.LCase() : "cell", this.openEditorAction = void 0 !== e.open_editor_action ? e.open_editor_action.LCase() : "dblclick", this.ajax = window.jQuery && e.ajax !== !1 ? !0 : !1, this.autoSave = void 0 !== e.auto_save ? e.auto_save : this.editable, this.autoSaveModel = void 0 !== e.auto_save_model ? e.auto_save_model : "row", this.autoSaveType = void 0 !== e.auto_save_type ? e.auto_save_type : "both", this.editableOnKeystroke = void 0 !== e.editable_on_keystroke ? e.editable_on_keystroke : !1, this.newRowPrefix = void 0 !== e.new_row_prefix ? e.new_row_prefix : "tr", this.formSubmitInterval = void 0 !== e.form_submit_interval ? e.form_submit_interval : 50, this.newRowPos = void 0 !== e.new_row_pos ? e.new_row_pos : "top", this.edtTypes = {none: "none", input: "input", textarea: "textarea", select: "select", multiple: "multiple", bool: "boolean", uploader: "uploader", command: "command", custom: "custom"}, this.editors = [], this.cellEditors = this.IsArray(e.cell_editors) ? e.cell_editors : [], this.editorTypes = [], this.editorCss = [], this.editorStyles = [], this.editorAttributes = [], this.customEditor = [], this.editorCustomSlcOptions = [], this.editorCustomSlcValues = [], this.editorSortSlcOptions = [], this.editorValuesSeparator = [], this.editorAllowEmptyValue = [], this.editorCmdColIndex = null, this.editorCmdBtns = {}, this.editorUploader = [], this.uplURI = [], this.uplPath = [], this.uplShowUpload = [], this.uplShowLink = [], this.linkCss = [], this.uplSqlField = [], this.uplLoaderImg = [], this.uplOkImg = [], this.uplMaxFileSize = [], this.uplValidExt = [], this.uplCss = [], this.uplOutputCss = [], this.uplDisplayCss = [], this.uplJsSuccess = [], this.uplRecordIdColIndex = [], this.showUpload = [], this.onBeforeOpenUploader = [], this.onAfterOpenUploader = [], this.onBeforeCloseUploader = [], this.onAfterCloseUploader = [];
        for (var c = 0; c < this.nbCells; c++) {
            var f = this.cellEditors[c];
            if (f)
                switch (this.editorTypes[c] = f.type, this.editorCss[c] = f.css, this.editorAttributes[c] = f.attributes, this.editorStyles[c] = f.style, this.editorCustomSlcOptions[c] = f.custom_slc_options, this.editorCustomSlcValues[c] = f.custom_slc_values, this.editorSortSlcOptions[c] = f.sort_slc_options, this.editorValuesSeparator[c] = f.values_separator, this.customEditor[c] = f.target, this.editorAllowEmptyValue[c] = f.allow_empty_value, this.editorTypes[c]) {
                    case this.edtTypes.command:
                        this.editorCmdColIndex = void 0 !== f.command_column_index ? parseInt(f.command_column_index, 10) : this.nbCells - 1, this.editorCmdBtns = f.buttons || {};
                        break;
                    case this.edtTypes.uploader:
                        var g = this.editorUploader[c] = f.uploader || {};
                        this.hasUploader = !0, this.uplURI[c] = g.hasOwnProperty("uri") ? g.uri : null, this.uplPath[c] = g.hasOwnProperty("path") ? g.path : null, this.uplShowUpload[c] = g.hasOwnProperty("show_upload") ? g.show_upload : !0, this.uplSqlField[c] = g.hasOwnProperty("sql_field") ? g.sql_field : "IMAGENAME", this.uplRecordIdColIndex[c] = g.hasOwnProperty("record_id_column_index") ? g.record_id_column_index : null, this.uplShowLink[c] = g.hasOwnProperty("show_link") ? g.show_link : !0, this.linkCss[c] = g.hasOwnProperty("link_css") ? g.link_css : "", this.uplLoaderImg[c] = g.hasOwnProperty("loader_image") ? g.loader_image : this.basePath + "themes/img_loader.gif", this.uplOkImg[c] = g.hasOwnProperty("ok_image") ? g.ok_image : "http://edittable.free.fr/ezEditTable/themes/icn_tick.png", this.uplMaxFileSize[c] = g.hasOwnProperty("max_file_size") ? g.max_file_size : "102400", this.uplValidExt[c] = g.hasOwnProperty("valid_extensions") ? g.valid_extensions : "jpg, jpeg, gif, png", this.uplCss[c] = g.hasOwnProperty("css") ? g.css : "ezUploaderEditor", this.uplOutputCss[c] = g.hasOwnProperty("output_css") ? g.output_css : "ezUploaderEditorOutput", this.uplDisplayCss[c] = g.hasOwnProperty("display_css") ? g.display_css : "ezUploaderEditorDisplay", this.uplJsSuccess[c] = g.hasOwnProperty("javascript_code_success") ? g.javascript_code_success : '<script>window.parent["{1}"].SetUploadSuccess(true); window.parent["{1}"].SetUploadName("{0}");window.parent["{1}"].ShowUpload();</script>', this.showUpload[c] = g.hasOwnProperty("show_upload") && this.IsFn(g.show_upload) ? g.show_upload : null, this.onBeforeOpenUploader[c] = g.hasOwnProperty("on_before_open") && this.IsFn(g.on_before_open) ? g.on_before_open : null, this.onAfterOpenUploader[c] = g.hasOwnProperty("on_after_open") && this.IsFn(g.on_after_open) ? g.on_after_open : null, this.onBeforeCloseUploader[c] = g.hasOwnProperty("on_before_close") && this.IsFn(g.on_before_close) ? g.on_before_close : null, this.onAfterCloseUploader[c] = g.hasOwnProperty("on_after_close") && this.IsFn(g.on_after_close) ? g.on_after_close : null
                    }
        }
        -1 != this.editorTypes.indexOf(this.edtTypes.command) && (this.editorModel = "row"), this.inputEditorCss = void 0 !== e.input_editor_css ? e.input_editor_css : "ezInputEditor", this.textareaEditorCss = void 0 !== e.textarea_editor_css ? e.textarea_editor_css : "ezTextareaEditor", this.selectEditorCss = void 0 !== e.select_editor_css ? e.select_editor_css : "ezSelectEditor", this.commandEditorCss = void 0 !== e.command_editor_css ? e.command_editor_css : "ezCommandEditor", this.modifiedCellCss = void 0 !== e.modified_cell_css ? e.modified_cell_css : "ezModifiedCell", this.cmdEnabledBtns = this.editorCmdBtns.hasOwnProperty("enable") ? this.editorCmdBtns.enable : ["update", "insert", "delete", "submit", "cancel"], this.cmdUpdateBtn = this.editorCmdBtns.hasOwnProperty("update") ? this.editorCmdBtns.update : {}, this.cmdInsertBtn = this.editorCmdBtns.hasOwnProperty("insert") ? this.editorCmdBtns.insert : {}, this.cmdDeleteBtn = this.editorCmdBtns.hasOwnProperty("delete") ? this.editorCmdBtns["delete"] : {}, this.cmdSubmitBtn = this.editorCmdBtns.hasOwnProperty("submit") ? this.editorCmdBtns.submit : {}, this.cmdCancelBtn = this.editorCmdBtns.hasOwnProperty("cancel") ? this.editorCmdBtns.cancel : {}, this.cmdUpdateBtnText = this.cmdUpdateBtn.hasOwnProperty("text") ? this.cmdUpdateBtn.text : "", this.cmdInsertBtnText = this.cmdInsertBtn.hasOwnProperty("text") ? this.cmdInsertBtn.text : "", this.cmdDeleteBtnText = this.cmdDeleteBtn.hasOwnProperty("text") ? this.cmdDeleteBtn.text : "", this.cmdSubmitBtnText = this.cmdSubmitBtn.hasOwnProperty("text") ? this.cmdSubmitBtn.text : "Submit", this.cmdCancelBtnText = this.cmdCancelBtn.hasOwnProperty("text") ? this.cmdCancelBtn.text : "Cancel", this.cmdUpdateBtnTitle = this.cmdUpdateBtn.hasOwnProperty("title") ? this.cmdUpdateBtn.title : "Edit record", this.cmdInsertBtnTitle = this.cmdInsertBtn.hasOwnProperty("title") ? this.cmdInsertBtn.title : "Create record", this.cmdDeleteBtnTitle = this.cmdDeleteBtn.hasOwnProperty("title") ? this.cmdDeleteBtn.title : "Delete record", this.cmdSubmitBtnTitle = this.cmdSubmitBtn.hasOwnProperty("title") ? this.cmdSubmitBtn.title : "Submit record", this.cmdCancelBtnTitle = this.cmdCancelBtn.hasOwnProperty("title") ? this.cmdCancelBtn.title : "", this.cmdCancelBtn = this.cmdCancelBtn.hasOwnProperty("icon") ? this.cmdCancelBtn.icon : '<img src="' + 'http://edittable.free.fr/ezEditTable/themes/icn_edit.gif" alt="" />', this.cmdUpdateBtnIcon = this.cmdUpdateBtn.hasOwnProperty("icon") ? this.cmdUpdateBtn.icon : '<img src="' + 'http://edittable.free.fr/ezEditTable/themes/icn_edit.gif" alt="" />', this.cmdInsertBtnIcon = this.cmdInsertBtn.hasOwnProperty("icon") ? this.cmdInsertBtn.icon : '<img src="http://edittable.free.fr/ezEditTable/themes/icn_add.gif" alt="" />', this.cmdDeleteBtnIcon = this.cmdDeleteBtn.hasOwnProperty("icon") ? this.cmdDeleteBtn.icon : '<img src="http://edittable.free.fr/ezEditTable/themes/icn_del.gif" alt="" />', this.cmdSubmitBtnIcon = this.cmdSubmitBtn.hasOwnProperty("icon") ? this.cmdSubmitBtn.icon : "", this.cmdCancelBtnIcon = this.cmdCancelBtn.hasOwnProperty("icon") ? this.cmdCancelBtn.icon : "", this.cmdUpdateBtnCss = this.cmdUpdateBtn.hasOwnProperty("css") ? this.cmdUpdateBtn.css : null, this.cmdInsertBtnCss = this.cmdInsertBtn.hasOwnProperty("css") ? this.cmdInsertBtn.css : null, this.cmdDeleteBtnCss = this.cmdDeleteBtn.hasOwnProperty("css") ? this.cmdDeleteBtn.css : null, this.cmdSubmitBtnCss = this.cmdSubmitBtn.hasOwnProperty("css") ? this.cmdSubmitBtn.css : null, this.cmdCancelBtnCss = this.cmdCancelBtn.hasOwnProperty("css") ? this.cmdCancelBtn.css : null, this.cmdUpdateBtnStyle = this.cmdUpdateBtn.hasOwnProperty("style") ? this.cmdUpdateBtn.style : null, this.cmdInsertBtnStyle = this.cmdInsertBtn.hasOwnProperty("style") ? this.cmdInsertBtn.style : null, this.cmdDeleteBtnStyle = this.cmdDeleteBtn.hasOwnProperty("style") ? this.cmdDeleteBtn.style : null, this.cmdSubmitBtnStyle = this.cmdSubmitBtn.hasOwnProperty("style") ? this.cmdSubmitBtn.style : null, this.cmdCancelBtnStyle = this.cmdCancelBtn.hasOwnProperty("style") ? this.cmdCancelBtn.style : null, this.cmdInsertBtnScroll = this.cmdInsertBtn.hasOwnProperty("scrollIntoView") ? this.cmdInsertBtn.scrollIntoView : !1, this.onEditableInit = this.IsFn(e.on_editable_initialized) ? e.on_editable_initialized : null, this.onBeforeOpenEditor = this.IsFn(e.on_before_open_editor) ? e.on_before_open_editor : null, this.onAfterOpenEditor = this.IsFn(e.on_after_open_editor) ? e.on_after_open_editor : null, this.onBeforeCloseEditor = this.IsFn(e.on_before_close_editor) ? e.on_before_close_editor : null, this.onAfterCloseEditor = this.IsFn(e.on_after_close_editor) ? e.on_after_close_editor : null, this.setCustomEditorValue = this.IsFn(e.set_custom_editor_value) ? e.set_custom_editor_value : null, this.getCustomEditorValue = this.IsFn(e.get_custom_editor_value) ? e.get_custom_editor_value : null, this.setCellModifiedValue = this.IsFn(e.set_cell_modified_value) ? e.set_cell_modified_value : null, this.validateModifiedValue = this.IsFn(e.validate_modified_value) ? e.validate_modified_value : null, this.openCustomEditor = this.IsFn(e.open_custom_editor) ? e.open_custom_editor : null, this.closeCustomEditor = this.IsFn(e.close_custom_editor) ? e.close_custom_editor : null, this.onAddedDomRow = this.IsFn(e.on_added_dom_row) ? e.on_added_dom_row : null, this.actions = this.IsObj(e.actions) ? e.actions : {}, this.updateConfig = void 0 !== this.actions.update ? this.actions.update : {}, this.insertConfig = void 0 !== this.actions.insert ? this.actions.insert : {}, this.deleteConfig = void 0 !== this.actions["delete"] ? this.actions["delete"] : {}, this.updateURI = this.updateConfig.hasOwnProperty("uri") ? this.updateConfig.uri : null, this.insertURI = this.insertConfig.hasOwnProperty("uri") ? this.insertConfig.uri : null, this.deleteURI = this.deleteConfig.hasOwnProperty("uri") ? this.deleteConfig.uri : null, this.updateFormMethod = this.updateConfig.hasOwnProperty("form_method") ? this.updateConfig.form_method.LCase() : "post", this.insertFormMethod = this.insertConfig.hasOwnProperty("form_method") ? this.insertConfig.form_method.LCase() : "post", this.deleteFormMethod = this.deleteConfig.hasOwnProperty("form_method") ? this.deleteConfig.form_method.LCase() : "post", this.updateSubmitMethod = this.updateConfig.hasOwnProperty("submit_method") ? this.updateConfig.submit_method.LCase() : this.ajax ? "ajax" : "form", this.insertSubmitMethod = this.insertConfig.hasOwnProperty("submit_method") ? this.insertConfig.submit_method.LCase() : this.ajax ? "ajax" : "form", this.deleteSubmitMethod = this.deleteConfig.hasOwnProperty("submit_method") ? this.deleteConfig.submit_method.LCase() : this.ajax ? "ajax" : "form", this.bulkDelete = this.deleteConfig.hasOwnProperty("bulk_delete") ? this.deleteConfig.bulk_delete : !1, this.defaultRecord = this.insertConfig.hasOwnProperty("default_record") && this.IsArray(this.insertConfig.default_record) ? this.insertConfig.default_record : null, this.updateParams = this.updateConfig.hasOwnProperty("param_names") && this.IsArray(this.updateConfig.param_names) ? this.updateConfig.param_names : null, this.insertParams = this.insertConfig.hasOwnProperty("param_names") && this.IsArray(this.insertConfig.param_names) ? this.insertConfig.param_names : null, this.deleteParams = this.deleteConfig.hasOwnProperty("param_names") && this.IsArray(this.deleteConfig.param_names) ? this.deleteConfig.param_names : null, this.onUpdateSubmit = this.updateConfig.hasOwnProperty("on_update_submit") && this.IsFn(this.updateConfig.on_update_submit) ? this.updateConfig.on_update_submit : null, this.onInsertSubmit = this.insertConfig.hasOwnProperty("on_insert_submit") && this.IsFn(this.insertConfig.on_insert_submit) ? this.insertConfig.on_insert_submit : null, this.onDeleteSubmit = this.deleteConfig.hasOwnProperty("on_delete_submit") && this.IsFn(this.deleteConfig.on_delete_submit) ? this.deleteConfig.on_delete_submit : null, this.onBeforeUpdateSubmit = this.updateConfig.hasOwnProperty("on_before_submit") && this.IsFn(this.updateConfig.on_before_submit) ? this.updateConfig.on_before_submit : null, this.onBeforeInsertSubmit = this.insertConfig.hasOwnProperty("on_before_submit") && this.IsFn(this.insertConfig.on_before_submit) ? this.insertConfig.on_before_submit : null, this.onBeforeDeleteSubmit = this.deleteConfig.hasOwnProperty("on_before_submit") && this.IsFn(this.deleteConfig.on_before_submit) ? this.deleteConfig.on_before_submit : null, this.onAfterUpdateSubmit = this.updateConfig.hasOwnProperty("on_after_submit") && this.IsFn(this.updateConfig.on_after_submit) ? this.updateConfig.on_after_submit : null, this.onAfterInsertSubmit = this.insertConfig.hasOwnProperty("on_after_submit") && this.IsFn(this.insertConfig.on_after_submit) ? this.insertConfig.on_after_submit : null, this.onAfterDeleteSubmit = this.deleteConfig.hasOwnProperty("on_after_submit") && this.IsFn(this.deleteConfig.on_after_submit) ? this.deleteConfig.on_after_submit : null, this.onUpdateError = this.updateConfig.hasOwnProperty("on_submit_error") && this.IsFn(this.updateConfig.on_submit_error) ? this.updateConfig.on_submit_error : null, this.onInsertError = this.insertConfig.hasOwnProperty("on_submit_error") && this.IsFn(this.insertConfig.on_submit_error) ? this.insertConfig.on_submit_error : null, this.onDeleteError = this.deleteConfig.hasOwnProperty("on_submit_error") && this.IsFn(this.deleteConfig.on_submit_error) ? this.deleteConfig.on_submit_error : null, this.checkUpdateResponseSanity = this.updateConfig.hasOwnProperty("check_response_sanity") && this.IsFn(this.updateConfig.check_response_sanity) ? this.updateConfig.check_response_sanity : null, this.checkInsertResponseSanity = this.insertConfig.hasOwnProperty("check_response_sanity") && this.IsFn(this.insertConfig.check_response_sanity) ? this.insertConfig.check_response_sanity : null, this.checkDeleteResponseSanity = this.deleteConfig.hasOwnProperty("check_response_sanity") && this.IsFn(this.deleteConfig.check_response_sanity) ? this.deleteConfig.check_response_sanity : null, this.processUpdateResponse = this.updateConfig.hasOwnProperty("process_response") && this.IsFn(this.updateConfig.process_response) ? this.updateConfig.process_response : null, this.processInsertResponse = this.insertConfig.hasOwnProperty("process_response") && this.IsFn(this.insertConfig.process_response) ? this.insertConfig.process_response : null, this.processDeleteResponse = this.deleteConfig.hasOwnProperty("process_response") && this.IsFn(this.deleteConfig.process_response) ? this.deleteConfig.process_response : null, this.msgSubmitOK = void 0 !== e.msg_submit_ok ? e.msg_submit_ok : "Changes were successfully submitted to server!", this.msgConfirmDelSelectedRows = void 0 !== e.msg_confirm_delete_selected_rows ? e.msg_confirm_delete_selected_rows : "Do you want to delete the selected row(s)?", this.msgErrOccur = void 0 !== e.msg_error_occured ? e.msg_error_occured : "An error occured!", this.msgSaveUnsuccess = void 0 !== e.msg_submit_unsuccessful ? e.msg_submit_unsuccessful : "Changes could not be saved!", this.msgUndefinedSubmitUrl = void 0 !== e.undefined_submit_url ? e.undefined_submit_url : "Changes could not be saved! Endpoint URL is not defined", this.msgNewRowNoUploader = void 0 !== e.msg_new_row_no_uploader ? e.msg_new_row_no_uploader : "Please save the newly added rows before using the Uploader.", this.msgInvalidData = void 0 !== e.msg_invalid_data ? e.msg_invalid_data : "Returned data is invalid.", this.ifrmContainer = {}, this.valuesSeparator = ", ", this.defaultRecordUndefinedValue = "...", this.newRowClass = "ezNewRow", this.recordKeyValue = "new", this.attrValue = "data-ez-slc-value", this.attrText = "data-ez-slc-text", this.attrCont = "data-ez-html", this.attrData = "data-ez-data", this.attrUplname = "data-ez-uplname", this.attrColIndex = "data-ez-col-index", this.attrRowIndex = "data-ez-row-index", this.savedRowsNb = {insert: 0, update: 0, "delete": 0}, this.prfxEdt = "edt_", this.prfxIFrm = "iframe_", this.prfxFrm = "form_", this.prfxScr = "scr_", this.prfxParam = "col_", this.prfxUplCont = "upl_", this.prfxUplForm = "upl_form_", this.prfxUplIframe = "upl_ifrm_", this.prfxUplInfo = "upl_info_", this.prfxUplOutput = "upl_output_", this.prfxUplBtn = "upl_btn_", this.prfxUplBtnClose = "upl_btn_close_", this.prfxUplImgDisplay = "upl_img_display_", this.prfxUplWinRef = "et_upl_", this.uplFileInp = "UPL_FILE", this.uplKeyInput = "RECORD_KEY", this.uplFldPath = "IMAGES_FOLDER_PATH", this.uplSqlFieldName = "SQL_FIELD", this.uplFileSize = "MAX_FILE_SIZE", this.uplValidExts = "VALID_EXTENSIONS", this.uplJsCode = "JS_CODE", this.Editable = new Editable(this), this.Selection = new Selection(this)
    }
}, Editable = function(a) {
    this.o = a
}, Selection = function(a) {
    this.o = a
}, Uploader = function(a, b) {
    this.o = a, this.colIndex = b, window[this.o.prfxUplWinRef + b + this.o.id] = this
};
Uploader.prototype = {divUpl: null, formUpl: null, fileUpl: null, hiddenFileSize: null, hiddenFolderPath: null, hiddenValidExt: null, hiddenKey: null, ifrmUpl: null, divUplInfo: null, divUplOutput: null, divUplBtnsCont: null, divUplBtn: null, divUplBtnClose: null, divUplDisplay: null, initialValue: null, isUploadSuccessful: !1, Init: function() {
        this.o.hasUploader && this.SetUploader()
    }, SetUploader: function() {
        this.divUpl = this.o.CreateElm("div", ["id", this.o.prfxUplCont + this.colIndex + this.o.id], ["style", "display:none; z-index:10001;"], ["class", this.o.uplCss[this.colIndex]]), this.formUpl = this.o.CreateElm("form", ["id", this.o.prfxUplForm + this.colIndex + this.o.id], ["name", this.o.prfxUplForm + this.colIndex + this.o.id], ["method", "POST"], ["action", this.o.uplURI[this.colIndex]], ["target", this.o.prfxUplIframe + this.colIndex + this.o.id], ["enctype", "multipart/form-data"]), this.fileUpl = this.o.CreateElm("input", ["id", this.o.uplFileInp], ["name", this.o.uplFileInp], ["type", "file"]), this.hiddenFileSize = this.o.CreateElm("input", ["name", this.o.uplFileSize], ["type", "hidden"], ["value", this.o.uplMaxFileSize[this.colIndex]]), this.hiddenFolderPath = this.o.CreateElm("input", ["name", this.o.uplFldPath], ["type", "hidden"], ["value", this.o.uplPath[this.colIndex]]), this.hiddenValidExt = this.o.CreateElm("input", ["name", this.o.uplValidExts], ["type", "hidden"], ["value", this.o.uplValidExt[this.colIndex]]), this.hiddenKey = this.o.CreateElm("input", ["name", this.o.uplKeyInput], ["type", "hidden"], ["value", this.o.recordKeyValue]), this.hiddenSqlField = this.o.CreateElm("input", ["name", this.o.uplSqlFieldName], ["type", "hidden"], ["value", this.o.uplSqlField[this.colIndex]]), this.hiddenUplWinRef = this.o.CreateElm("input", ["name", this.o.uplJsCode], ["type", "hidden"], ["value", this.o.uplJsSuccess[this.colIndex]]), this.ifrmUpl = this.o.CreateElm("iframe", ["id", this.o.prfxUplIframe + this.colIndex + this.o.id], ["name", this.o.prfxUplIframe + this.colIndex + this.o.id], ["style", "display:none; left:-10001;"]), this.divUplInfo = this.o.CreateElm("div", ["id", this.o.prfxUplInfo + this.colIndex + this.o.id]), this.divUplOutput = this.o.CreateElm("div", ["id", this.o.prfxUplOutput + this.colIndex + this.o.id], ["class", this.o.uplOutputCss[this.colIndex]]), this.divUplBtnsCont = this.o.CreateElm("div", ["style", "text-align:right"]), this.divUplBtn = this.o.CreateElm("button", ["id", this.o.prfxUplBtn + this.colIndex + this.o.id], ["style", "display:none;"]), this.divUplBtnClose = this.o.CreateElm("button", ["id", this.o.prfxUplBtnClose + this.colIndex + this.o.id]), this.divUplDisplay = this.o.CreateElm("div", ["id", this.o.prfxUplImgDisplay + this.colIndex + this.o.id], ["class", this.o.uplDisplayCss[this.colIndex]]), this.o.Css.Has(this.divUpl, this.o.uplCss[this.colIndex]) || (this.o.Css.Add(this.divUpl, this.o.uplCss[this.colIndex]), this.o.Css.Add(this.divUplOutput, this.o.uplOutputCss[this.colIndex]), this.o.Css.Add(this.divUplDisplay, this.o.uplDisplayCss[this.colIndex]), this.divUpl.style.cssText = "display:none; z-index:10001;", this.divUplBtnsCont.style.cssText = "text-align:right", this.divUplBtn.style.cssText = "display:none;", this.formUpl = document.createElement('<form id="' + this.o.prfxUplForm + this.colIndex + this.o.id + '" name="' + this.o.prfxUplForm + this.colIndex + this.o.id + '" method="POST" action="' + this.o.uplURI[this.colIndex] + '" target="' + this.o.prfxUplIframe + this.colIndex + this.o.id + '" enctype="multipart/form-data"></form>'), this.ifrmUpl = document.createElement('<iframe name="' + this.o.prfxUplIframe + this.colIndex + this.o.id + '" id="' + this.o.prfxUplIframe + this.colIndex + this.o.id + '" style="display:none; left:-10001;"></iframe>')), this.divUplInfo.innerHTML = parseInt(this.o.uplMaxFileSize[this.colIndex] / 1024, 10) + "Kb max (" + this.o.uplValidExt[this.colIndex].toString() + ")", this.divUplBtn.appendChild(this.o.CreateText("Upload")), this.divUplBtnClose.appendChild(this.o.CreateText("Close")), this.divUplBtnsCont.appendChild(this.divUplBtn), this.divUplBtnsCont.appendChild(this.divUplBtnClose), this.formUpl.appendChild(this.fileUpl), this.formUpl.appendChild(this.hiddenFileSize), this.formUpl.appendChild(this.hiddenFolderPath), this.formUpl.appendChild(this.hiddenUplWinRef), this.formUpl.appendChild(this.hiddenValidExt), this.formUpl.appendChild(this.hiddenKey), this.formUpl.appendChild(this.hiddenSqlField), this.divUpl.appendChild(this.formUpl), this.divUpl.appendChild(this.ifrmUpl), this.divUpl.appendChild(this.divUplInfo), this.divUpl.appendChild(this.divUplOutput), this.divUpl.appendChild(this.divUplBtnsCont), this.divUpl.appendChild(this.divUplDisplay), this.o.table.parentNode.insertBefore(this.divUpl, this.o.table);
        var a = this;
        this.ifrmUpl.onload = this.ifrmUpl.onreadystatechange = function() {
            if (!this.readyState || "loaded" == this.readyState || "complete" == this.readyState)
                try {
                    var b = this.contentDocument || this.contentWindow.document;
                    "about:blank" != b.location.href && (a.Output(b.body.innerHTML), a.iframe.src = "about:blank", a.HideUploadButton())
                } catch (c) {
                }
        }, this.o.Event.Add(this.fileUpl, "click", function() {
            a.OnUplClick()
        }), this.o.Event.Add(this.divUplBtn, "click", function() {
            a.Upload()
        }), this.o.Event.Add(this.divUplBtnClose, "click", function() {
            a.Close(a.o.Selection.GetActiveRow().cells[a.colIndex])
        });
        var b = this.o.uplJsSuccess[this.colIndex].replace(/\{1\}/g, this.o.prfxUplWinRef + this.colIndex + this.o.id);
        this.hiddenUplWinRef.value = b
    }, GetValue: function() {
        return this.fileUpl.value
    }, HasValueChanged: function() {
        return this.initialValue != this.GetValue()
    }, OnUplClick: function() {
        this.ShowUploadButton()
    }, Upload: function() {
        this.ShowLoader(), this.formUpl.submit()
    }, SetRecordKey: function(a) {
        this.hiddenKey.value = a
    }, GetRecordKey: function() {
        return this.hiddenKey.value
    }, ShowUploadButton: function() {
        this.divUplBtn.style.display = "inline"
    }, HideUploadButton: function() {
        this.divUplBtn.style.display = "none"
    }, ShowUploadContainer: function() {
        this.divUplDisplay.style.display = "block"
    }, HideUploadContainer: function() {
        this.divUplDisplay.style.display = "none"
    }, ShowUpload: function() {
        if (this.o.uplShowUpload[this.colIndex]) {
            var a = this.o.Selection.GetActiveRow();
            if (this.o.showUpload[this.colIndex])
                return this.ShowUploadContainer(), void this.o.showUpload[this.colIndex].call(this, this.o, this.divUplDisplay, this.GetUploadName(), this.o.uplPath[this.colIndex]);
            if (a) {
                var b = this.GetUploadName();
                b ? (this.divUplDisplay.innerHTML = this.o.uplShowLink[this.colIndex] ? this.GetUploadLinkHtml() : '<img src="' + this.o.uplPath[this.colIndex] + b + '" alt="' + b + '" />', this.ShowUploadContainer(), this.divUpl.scrollIntoView(!1)) : this.ClearUpload()
            }
        }
    }, ClearUpload: function() {
        this.divUplDisplay.innerHTML = "", this.HideUploadContainer()
    }, GetUploadName: function() {
        var a = this.o.Selection.GetActiveRow().cells[this.colIndex];
        return a ? a.getAttribute(this.o.attrUplname) : null
    }, SetUploadName: function(a) {
        var b = this.o.Selection.GetActiveRow().cells[this.colIndex];
        b && b.setAttribute(this.o.attrUplname, a)
    }, GetUploadLinkHtml: function() {
        var a = this.GetUploadName();
        return'<a href="' + this.o.uplPath[this.colIndex] + a + '" target="blank" class="' + this.o.linkCss[this.colIndex] + '">' + a.replace(this.GetRecordKey() + "_", "") + "</a>"
    }, Open: function(a) {
        if (a) {
            if (this.o.Css.Has(a.parentNode, this.o.newRowClass) || !a.parentNode.getAttribute("id"))
                return void alert(this.o.msgNewRowNoUploader);
            a.appendChild(this.divUpl), this.o.onBeforeOpenUploader[this.colIndex] && this.o.onBeforeOpenUploader[this.colIndex].call(this, this.o, this.divUpl, a);
            var b = this.o.uplRecordIdColIndex[this.colIndex] ? this.o.Selection.GetActiveRow()[this.o.uplRecordIdColIndex[this.colIndex]] : this.o.Selection.GetActiveRow().getAttribute("id").replace(this.o.newRowPrefix, "");
            "" !== b && (this.divUpl.style.display = "", this.SetRecordKey(b), this.initialValue = this.GetValue(), this.SetUploadSuccess(!1), this.ShowUpload()), this.o.onAfterOpenUploader[this.colIndex] && this.o.onAfterOpenUploader[this.colIndex].call(this, this.o, this.divUpl, a)
        }
    }, Close: function(a) {
        if ("none" != this.divUpl.style.display) {
            if (this.o.onBeforeCloseUploader[this.colIndex] && this.o.onBeforeCloseUploader[this.colIndex].call(this, this.o, this.divUpl, a), a && this.IsUploadSuccessful())
                if (this.o.uplShowLink[this.colIndex]) {
                    var b = this.o.CreateElm("div");
                    b.innerHTML = this.divUplDisplay.innerHTML, a.appendChild(b)
                } else {
                    var c = this.o.Tag(a, "img")[0];
                    c && (c.src = this.o.uplOkImg[this.colIndex])
                }
            this.Output(""), this.SetRecordKey(""), this.ClearUpload(), this.HideUploadButton(), this.divUpl.style.display = "none", this.o.StandardBody().appendChild(this.divUpl), this.o.onAfterCloseUploader[this.colIndex] && this.o.onAfterCloseUploader[this.colIndex].call(this, this.o, this.divUpl, a)
        }
    }, Output: function(a) {
        this.divUplOutput.innerHTML = a
    }, SetUploadSuccess: function(a) {
        this.isUploadSuccessful = a
    }, IsUploadSuccessful: function() {
        return this.isUploadSuccessful
    }, ShowLoader: function() {
        this.Output('<img src="' + this.o.uplLoaderImg[this.colIndex] + '" alt="Please wait..." />')
    }, HideLoader: function() {
        this.Output("")
    }}, Editable.prototype = {onEditAdded: !1, activeCellEditor: null, openCellEditor: null, activeRow: null, modifiedRows: [], newRows: [], addedRows: [], deletedRows: [], Init: function() {
        this.o.editable && (this.SetEvents(), this.SetCellsEditor(), this.o.onEditableInit && this.o.onEditableInit.call(null, this.o))
    }, Set: function() {
        this.o.editable = !0, this.SetEvents()
    }, Remove: function() {
        this.o.editable = !1, this.RemoveEvents()
    }, SetEvents: function() {
        if (!this.onEditAdded) {
            var a = this;
            this.o.Event.Bind(this.o.table, this.o.openEditorAction, function(b) {
                a.Edit.call(a, b)
            }), this.onEditAdded = !0
        }
    }, RemoveEvents: function() {
        if (this.onEditAdded) {
            var a = this;
            this.o.Event.Unbind(this.o.table, this.o.openEditorAction, function(b) {
                a.Edit.call(a, b)
            }), this.onEditAdded = !1
        }
    }, SetCellsEditor: function() {
        for (var a = 0; a < this.o.nbCells; a++)
            if (this.o.editorTypes.length == this.o.nbCells)
                switch (this.o.editorTypes[a]) {
                    case this.o.edtTypes.none:
                        this.o.editors[a] = null;
                        break;
                    case this.o.edtTypes.input:
                        this.o.editors[a] = this.CreateInputEditor(a);
                        break;
                    case this.o.edtTypes.textarea:
                        this.o.editors[a] = this.CreateMultilineEditor(a);
                        break;
                    case this.o.edtTypes.select:
                    case this.o.edtTypes.multiple:
                        this.o.editors[a] = this.CreateSelectEditor(a);
                        break;
                    case this.o.edtTypes.bool:
                        this.o.editors[a] = {};
                        break;
                    case this.o.edtTypes.uploader:
                        this.o.editors[a] = this.CreateUploaderEditor(a);
                        break;
                    case this.o.edtTypes.command:
                        this.SetCommandEditor(a), this.o.editors[a] = null;
                        break;
                    case this.o.edtTypes.custom:
                        this.o.editors[a] = this.o.Get(this.o.customEditor[a]);
                        break;
                    default:
                        this.o.editors[a] = null
                }
            else
                this.o.editorTypes[a] = this.o.edtTypes.input, this.o.editors[a] = this.CreateInputEditor(a)
    }, CreateInputEditor: function(a) {
        if (void 0 === a)
            return null;
        var b = this.o.CreateElm(this.o.edtTypes.input, ["id", this.o.prfxEdt + a + "_" + this.o.id], ["type", "text"], ["class", this.o.inputEditorCss], [this.o.attrColIndex, a]), c = this.o.editorAttributes[a];
        if (c)
            for (var d = 0; d < c.length; d++)
                b.setAttribute(c[d][0], c[d][1]);
        "" === b.className && (b.className = this.o.inputEditorCss), this.o.editorCss[a] && this.o.Css.Add(b, this.o.editorCss[a]), this.o.editorStyles[a] && (b.style.cssText = this.o.editorStyles[a]);
        var e = this;
        return this.o.Event.Add(b, "focus", function(a) {
            e.Event.OnInputFocus.call(e, a)
        }), this.o.Event.Add(b, "blur", function(a) {
            e.Event.OnBlur.call(e, a)
        }), b
    }, CreateMultilineEditor: function(a) {
        if (void 0 === a)
            return null;
        var b = this.o.CreateElm(this.o.edtTypes.textarea, ["id", this.o.prfxEdt + a + "_" + this.o.id], ["class", this.o.textareaEditorCss], [this.o.attrColIndex, a]), c = this.o.editorAttributes[a];
        if (c)
            for (var d = 0; d < c.length; d++)
                b.setAttribute(c[d][0], c[d][1]);
        "" === b.className && (b.className = this.o.textareaEditorCss), this.o.editorCss[a] && this.o.Css.Add(b, this.o.editorCss[a]), this.o.editorStyles[a] && (b.style.cssText = this.o.editorStyles[a]);
        var e = this;
        return this.o.Event.Add(b, "focus", function(a) {
            e.Event.OnInputFocus.call(e, a)
        }), this.o.Event.Add(b, "blur", function(a) {
            e.Event.OnBlur.call(e, a)
        }), this.o.Event.Add(b, "keypress", function(a) {
            e.Event.OnKeyPress.call(e, a)
        }), b
    }, CreateSelectEditor: function(a) {
        if (void 0 === a)
            return null;
        var b = this.o.CreateElm(this.o.edtTypes.select, ["id", this.o.prfxEdt + a + "_" + this.o.id], ["class", this.o.selectEditorCss], [this.o.attrColIndex, a]);
        this.o.IsEditorType(a, this.o.edtTypes.multiple) && b.setAttribute("multiple", "multiple");
        var c = this.o.editorAttributes[a];
        if (c)
            for (var d = 0; d < c.length; d++)
                b.setAttribute(c[d][0], c[d][1]);
        "" === b.className && (b.className = this.o.selectEditorCss), this.o.editorCss[a] && this.o.Css.Add(b, this.o.editorCss[a]), this.o.editorStyles[a] && (b.style.cssText = this.o.editorStyles[a]);
        var e = [], f = [];
        if (this.o.editorCustomSlcOptions[a])
            for (var d = 0; d < this.o.editorCustomSlcOptions[a].length; d++) {
                var g = this.o.editorCustomSlcOptions[a][d];
                if (this.o.editorCustomSlcValues[a]) {
                    var h = this.o.editorCustomSlcValues[a][d];
                    -1 == f.indexOf(h) && f.push(h)
                }
                -1 == e.indexOf(g) && e.push(g)
            }
        else
            for (var d = this.o.startRow; d < this.o.GetRowsNb(); d++) {
                var i = this.o.table.rows[d], j = i.cells[a];
                if (i && j) {
                    var g = this.o.GetText(j);
                    -1 == e.indexOf(g) && e.push(g)
                }
            }
        if (this.o.editorSortSlcOptions[a]) {
            var k = this.o.editorSortSlcOptions[a].LCase();
            if ("numdesc" == k)
                try {
                    e.sort(this.o.Sort.NumDesc)
                } catch (l) {
                }
            else if ("numasc" == k)
                try {
                    e.sort(this.o.Sort.NumAsc)
                } catch (l) {
                }
            else
                try {
                    e.sort(this.o.Sort.IgnoreCase)
                } catch (l) {
                }
        }
        for (var m = 0; m < e.length; m++) {
            var n = this.o.CreateElm("option", ["value", f[m] || e[m]]);
            n.appendChild(this.o.CreateText(e[m])), b.appendChild(n)
        }
        var o = this;
        return this.o.Event.Add(b, "change", function(a) {
            var c = o.o.GetCell(a);
            c && (c.setAttribute(o.o.attrText, b.options[b.selectedIndex].text), c.setAttribute(o.o.attrValue, b.options[b.selectedIndex].value), b.setAttribute(o.o.attrText, b.options[b.selectedIndex].text), b.setAttribute(o.o.attrValue, b.options[b.selectedIndex].value))
        }), this.o.Event.Add(b, "blur", function(a) {
            o.Event.OnBlur.call(o, a)
        }), this.o.Event.Add(b, "keypress", function(a) {
            o.Event.OnKeyPress.call(o, a)
        }), b
    }, SetCommandEditor: function(a) {
        if (void 0 !== a && this.o.IsEditorType(a, this.o.edtTypes.command)) {
            this.edtBtns = [], this.addBtns = [], this.delBtns = [], this.submitBtns = [], this.cancelBtns = [];
            for (var b = this.o.Editable, c = this.o, d = this.o.startRow; d < this.o.GetRowsNb(); d++) {
                var e = this.o.table.rows[d], f = e.cells[a];
                if (e && f) {
                    var g = this.o.CreateElm("div", ["class", this.o.commandEditorCss]);
                    if (-1 != this.o.cmdEnabledBtns.indexOf("update")) {
                        var h = this.o.CreateElm("button", ["id", "editBtn_" + d + "_" + this.o.id], ["title", this.o.cmdUpdateBtnTitle], ["css", this.o.cmdUpdateBtnCss], [this.o.attrColIndex, d]);
                        this.o.cmdUpdateBtnStyle && (h.style.cssText = this.o.cmdUpdateBtnStyle), h.innerHTML = this.o.cmdUpdateBtnIcon + this.o.cmdUpdateBtnText, g.appendChild(h), this.o.Event.Add(h, "click", function(a) {
                            b.Edit.call(b, a)
                        }), -1 == this.edtBtns.indexOf(h) && (this.edtBtns[d] = h)
                    }
                    if (-1 != this.o.cmdEnabledBtns.indexOf("insert")) {
                        var i = this.o.CreateElm("button", ["id", "createBtn_" + d + "_" + this.o.id], ["title", this.o.cmdInsertBtnTitle], ["css", this.o.cmdInsertBtnCss], [this.o.attrColIndex, d]);
                        this.o.cmdInsertBtnStyle && (i.style.cssText = this.o.cmdInsertBtnStyle), i.innerHTML = this.o.cmdInsertBtnIcon + this.o.cmdInsertBtnText, g.appendChild(i), this.o.Event.Add(i, "click", function() {
                            b.AddNewRow(), b.SetCommandEditor(b.o.editorCmdColIndex)
                        }), -1 == this.addBtns.indexOf(i) && (this.addBtns[d] = i)
                    }
                    if (-1 != this.o.cmdEnabledBtns.indexOf("delete")) {
                        var j = this.o.CreateElm("button", ["id", "delBtn_" + d + "_" + this.o.id], ["title", this.o.cmdDeleteBtnTitle], ["css", this.o.cmdDeleteBtnCss], [this.o.attrColIndex, d]);
                        this.o.cmdDeleteBtnStyle && (j.style.cssText = this.o.cmdDeleteBtnStyle), j.innerHTML = this.o.cmdDeleteBtnIcon + this.o.cmdDeleteBtnText, g.appendChild(j), this.o.Event.Add(j, "click", function() {
                            b.SubmitDeletedRows()
                        }), -1 == this.delBtns.indexOf(j) && (this.delBtns[d] = j)
                    }
                    if (-1 != this.o.cmdEnabledBtns.indexOf("submit")) {
                        var k = this.o.CreateElm("button", ["id", "postBtn_" + d + "_" + this.o.id], ["title", this.o.cmdSubmitBtnTitle], ["style", "display:none;"], ["css", this.o.cmdSubmitBtnCss], [this.o.attrColIndex, d]);
                        k.style.display = "none", this.o.cmdSubmitBtnStyle && (k.style.cssText += this.o.cmdSubmitBtnStyle), k.innerHTML = this.o.cmdSubmitBtnIcon + this.o.cmdSubmitBtnText, g.appendChild(k), this.o.Event.Add(k, "click", function(a) {
                            c.Event.Stop(a), b.CloseRowEditor(), b.SubmitAll()
                        }), -1 == this.submitBtns.indexOf(k) && (this.submitBtns[d] = k)
                    }
                    if (-1 != this.o.cmdEnabledBtns.indexOf("cancel")) {
                        var l = this.o.CreateElm("button", ["id", "cancelBtn_" + d + "_" + this.o.id], ["title", this.o.cmdCancelBtnTitle], ["style", "display:none;"], ["css", this.o.cmdCancelBtnCss], [this.o.attrColIndex, d]);
                        l.style.display = "none", this.o.cmdCancelBtnStyle && (l.style.cssText += this.o.cmdCancelBtnStyle), l.innerHTML = '<img src="http://tablefilter.free.fr/TableFilter/ezEditTable/themes/icn_add.gif"/>', g.appendChild(l), this.o.Event.Add(l, "click", function(a) {
                            c.Event.Stop(a), b.CloseRowEditor()
                        }), -1 == this.cancelBtns.indexOf(l) && (this.cancelBtns[d] = l)
                    }
                    f.innerHTML = "", f.appendChild(g)
                }
            }
        }
    }, CreateUploaderEditor: function(a) {
        var b = new Uploader(this.o, a);
        return b.Init(), b
    }, OpenCellEditor: function(a) {
        if (a) {
            var b = a.cellIndex, c = this.o.editors[b];
            if (this.o.onBeforeOpenEditor && this.o.onBeforeOpenEditor.call(null, this.o, a, c), this.activeCellEditor = a, this.openCellEditor = b, this.o.IsEditorType(b, this.o.edtTypes.uploader))
                c.Open(a);
            else {
                var d = this.o.GetText(a);
                this.SetCellCache(a, d), this.SetEditorValue(b, d), this.o.IsEditorType(b, this.o.edtTypes.custom) ? this.o.openCustomEditor && this.o.openCustomEditor.call(null, this.o, a, c) : (a.innerHTML = "", a.appendChild(c), "cell" == this.o.editorModel && this.SetEditorFocus(b))
            }
            this.o.onAfterOpenEditor && this.o.onAfterOpenEditor.call(null, this.o, a, c)
        }
    }, OpenRowEditor: function(a) {
        if (a) {
            this.activeRow = a;
            for (var b = 0; b < this.o.nbCells; b++)
                if (this.o.editors[b] && !this.o.IsEditorType(b, this.o.edtTypes.bool) && !this.o.IsEditorType(b, this.o.edtTypes.command)) {
                    var c = a.cells[b];
                    this.OpenCellEditor(c), this.o.Selection.activeCell && this.o.Selection.activeCell.cellIndex === b && this.SetEditorFocus(b)
                }
            this.ShowCommandBtns(a.rowIndex, !1)
        }
    }, CloseRowEditor: function() {
        if (this.activeRow) {
            for (var a = this.activeRow, b = 0; b < this.o.nbCells; b++)
                this.o.editors[b] && !this.o.IsEditorType(b, this.o.edtTypes.bool) && (this.activeCellEditor = a.cells[b], this.CloseCellEditor(b));
            this.ShowCommandBtns(a.rowIndex, !0), this.o.autoSave && this.AutoSubmit(), this.activeRow = null
        }
    }, ShowCommandBtns: function(a, b) {
        void 0 !== a && void 0 !== b && "row" == this.o.editorModel && this.edtBtns && this.addBtns && this.delBtns && this.submitBtns && this.cancelBtns && (b ? (this.edtBtns[a] && (this.edtBtns[a].style.display = "inline"), this.addBtns[a] && (this.addBtns[a].style.display = "inline"), this.delBtns[a] && (this.delBtns[a].style.display = "inline"), this.submitBtns[a] && (this.submitBtns[a].style.display = "none"), this.cancelBtns[a] && (this.cancelBtns[a].style.display = "none")) : (this.edtBtns[a] && (this.edtBtns[a].style.display = "none"), this.addBtns[a] && (this.addBtns[a].style.display = "none"), this.delBtns[a] && (this.delBtns[a].style.display = "none"), this.submitBtns[a] && (this.submitBtns[a].style.display = "inline"), this.cancelBtns[a] && (this.cancelBtns[a].style.display = "inline")))
    }, CloseCellEditor: function(a) {
        if (void 0 !== a && this.activeCellEditor) {
            this.o.onBeforeCloseEditor && this.o.onBeforeCloseEditor.call(null, this.o, this.activeCellEditor, this.o.editors[a]);
            var b, c = this.GetEditorValue(a), d = this.GetCellCache(this.activeCellEditor), e = d[1], f = d[0], g = this.o.editors[a];
            if (this.o.IsEditorType(a, this.o.edtTypes.uploader))
                g.Close(this.activeCellEditor);
            else {
                if (this.o.IsEditorType(a, this.o.edtTypes.multiple))
                    for (var h = 0; h < g.options.length; h++)
                        g.options[h].selected && (g.options[h].selected = !1);
                if (c != e) {
                    var i = new RegExp(e.RegexpEscape(), "g");
                    b = i.test(f) && "" !== e ? f.replace(i, c) : c
                }
                if (this.o.setCellModifiedValue)
                    this.o.setCellModifiedValue.call(null, this.o, this.activeCellEditor, b);
                else {
                    try {
                        this.activeCellEditor.removeChild(g)
                    } catch (j) {
                        this.activeCellEditor && (this.activeCellEditor.innerHTML = "")
                    }
                    try {
                        !this.o.validateModifiedValue || this.o.validateModifiedValue.call(null, this.o, a, e, c, this.activeCellEditor, g) ? (this.activeCellEditor.innerHTML = this.o.editorAllowEmptyValue[a] ? void 0 !== b ? b : f : void 0 !== b && "" !== b.Trim() ? b : f, c != e && (this.o.IsEditorType(a, this.o.edtTypes.select) && (b = g.getAttribute(this.o.attrValue)), "row" == this.o.editorModel ? this.SetModifiedCell(this.activeCellEditor, this.activeCellEditor.innerHTML, e) : this.SetModifiedCell(this.activeCellEditor, b, e))) : this.activeCellEditor.innerHTML = e || f
                    } catch (j) {
                    }
                }
                this.o.onAfterCloseEditor && this.o.onAfterCloseEditor.call(null, this.o, this.activeCellEditor, g), this.RemoveCellCache(this.activeCellEditor), this.o.IsEditorType(a, this.o.edtTypes.custom) && this.o.closeCustomEditor && this.o.closeCustomEditor.call(null, this.o, this.activeCellEditor, g)
            }
            this.o.autoSave && "cell" === this.o.editorModel && "cell" === this.o.autoSaveModel && this.AutoSubmit(), this.activeCellEditor = null, this.openCellEditor = null
        }
    }, IsEditorOpen: function(a) {
        return this.openCellEditor == a
    }, IsRowEditorOpen: function() {
        return null !== this.activeRow
    }, SetEditorFocus: function(a) {
        !this.o.editors[a] || !this.IsEditorOpen(a) && !this.activeRow || this.o.IsEditorType(a, this.o.edtTypes.custom) || this.o.IsEditorType(a, this.o.edtTypes.command) || this.o.IsEditorType(a, this.o.edtTypes.bool) || this.o.editors[a].focus()
    }, BlurEditor: function(a) {
        this.o.editors[a] && (this.IsEditorOpen(a) || this.activeRow) && this.o.editors[a].blur()
    }, SetModifiedCell: function(a, b, c) {
        if (a) {
            var d = a.parentNode;
            if (!this.o.Css.Has(d, this.o.newRowClass)) {
                var e = {};
                e.values = [], e.urlParams = "", e.modified = [];
                var f = this.GetModifiedRow(d.rowIndex);
                if (f) {
                    var g = f[1];
                    g.values[a.cellIndex] = b, g.modified[a.cellIndex] = !0;
                    var h = this.o.prfxParam + a.cellIndex, i = h + "=" + encodeURIComponent(c), j = h + "=" + encodeURIComponent(b);
                    g.urlParams = g.urlParams.replace(i, j)
                } else {
                    for (var k = 0; k < d.cells.length; k++) {
                        a.cellIndex == k && this.o.Css.Add(a, this.o.modifiedCellCss);
                        var l = this.GetCellCache(d.cells[k]), m = a.cellIndex == k ? b : "row" != this.o.editorModel || this.o.IsEditorType(k, this.o.edtTypes.none) ? this.o.GetText(d.cells[k]) : l[1] || this.o.GetText(d.cells[k]);
                        this.o.IsEditorType(k, this.o.edtTypes.bool) && this.o.Tag(d.cells[k], "input").length > 0 && (m = this.o.Tag(d.cells[k], "input")[0].checked);
                        var h = this.o.prfxParam + k;
                        e.values.push(m), e.modified.push(a.cellIndex == k ? !0 : !1), e.urlParams += "&" + h + "=" + encodeURIComponent(m)
                    }
                    this.modifiedRows.push([d.rowIndex, e])
                }
            }
        }
    }, GetModifiedRow: function(a) {
        if (void 0 === a)
            return null;
        for (var b = 0; b < this.modifiedRows.length; b++)
            if (this.modifiedRows[b][0] == a)
                return this.modifiedRows[b];
        return null
    }, GetModifiedRows: function() {
        return this.modifiedRows
    }, GetAddedRows: function() {
        return this.addedRows
    }, SetRowsObject: function(a, b) {
        if (a)
            for (var c = 0; c < a.length; c++) {
                var d = a[c];
                if (d) {
                    var e = {};
                    e.values = [], e.urlParams = "", e.modified = [];
                    for (var f = 0; f < d.cells.length; f++) {
                        var g = d.cells[f], h = this.o.GetText(d.cells[f]);
                        this.o.IsEditorType(f, this.o.edtTypes.bool) && this.o.Tag(g, "input").length > 0 ? h = this.o.Tag(g, "input")[0].checked : this.o.IsEditorType(f, this.o.edtTypes.select) && (h = g.getAttribute(this.o.attrValue));
                        var i = this.o.prfxParam + f;
                        e.values.push(h), e.modified.push("delete" == b ? !1 : !0), e.urlParams += "&" + i + "=" + encodeURIComponent(h)
                    }
                    "delete" == b ? this.deletedRows.push([d.rowIndex, e]) : "insert" == b ? this.addedRows.push([d.rowIndex, e]) : this.modifiedRows.push([d.rowIndex, e])
                }
            }
    }, GetDeletedRows: function() {
        return this.deletedRows
    }, RemoveModifiedRow: function(a) {
        if (void 0 !== a)
            for (var b = 0; b < this.GetModifiedRows().length; b++)
                if (this.GetModifiedRows()[b][0] == a) {
                    this.modifiedRows.splice(b, 1);
                    break
                }
    }, RemoveModifiedCellMark: function(a, b) {
        if (void 0 !== a)
            for (var c = this.o.table.rows[a], d = c.cells, e = 0; e < d.length; e++) {
                var f = d[e];
                b && -1 == b.indexOf(e) || this.o.Css.Remove(f, this.o.modifiedCellCss)
            }
    }, SetCellCache: function(a, b, c) {
        if (a && void 0 !== b) {
            var d = c || "" === c ? c : a.innerHTML;
            a.setAttribute(this.o.attrCont, escape(d)), a.setAttribute(this.o.attrData, escape(b))
        }
    }, GetCellCache: function(a) {
        if (!a)
            return[];
        var b, c;
        return void 0 !== a.attributes[this.o.attrCont] && (b = unescape(a.getAttribute(this.o.attrCont))), void 0 !== a.attributes[this.o.attrData] && (c = unescape(a.getAttribute(this.o.attrData))), [b, c]
    }, RemoveCellCache: function(a) {
        a && (void 0 !== a.attributes[this.o.attrCont] && a.removeAttribute(this.o.attrCont), void 0 !== a.attributes[this.o.attrData] && a.removeAttribute(this.o.attrData))
    }, GetEditorValue: function(a) {
        var b = this.o.editors[a], c = this.o.editorTypes[a], d = "";
        if (!b || !c)
            return d;
        switch (c.LCase()) {
            case this.o.edtTypes.input:
            case this.o.edtTypes.textarea:
                d = b.value;
                break;
            case this.o.edtTypes.select:
                d = b.getAttribute(this.o.attrText) || b.value;
                break;
            case this.o.edtTypes.multiple:
                for (var e = this.o.editorValuesSeparator[a] ? this.o.editorValuesSeparator[a] : this.o.valuesSeparator, f = 0; f < b.options.length; f++)
                    b.options[f].selected && (d = d.concat(b.options[f].value, e));
                d = d.substring(0, d.length - e.length);
                break;
            case this.o.edtTypes.custom:
                this.o.getCustomEditorValue && (d = this.o.getCustomEditorValue.call(null, this.o, b, a))
        }
        return d
    }, SetEditorValue: function(a, b) {
        var c = this.o.editors[a], d = this.o.editorTypes[a];
        switch (d.LCase()) {
            case this.o.edtTypes.input:
            case this.o.edtTypes.textarea:
            case this.o.edtTypes.select:
                c.value = b;
                break;
            case this.o.edtTypes.multiple:
                for (var e = 0; e < c.options.length; e++)
                    c.options[e].value == b && (c.options[e].selected = !0);
                break;
            case this.o.edtTypes.custom:
                this.o.setCustomEditorValue && this.o.setCustomEditorValue.call(null, this.o, c, a, b)
            }
    }, GetCheckBox: function(a) {
        if (!a)
            return null;
        var b = this.o.Tag(a, "input")[0];
        return"checkbox" == b.getAttribute("type").LCase() ? b : null
    }, SetCheckBoxValue: function(a, b) {
        if (b) {
            var c = this.o.Editable, d = c.GetCheckBox(b);
            if (d && "checkbox" == d.type.LCase()) {
                this.o.Event.GetElement(a) != d && (d.checked = d.checked ? !1 : !0);
                var e = !d.checked;
                c.SetCellCache(b, e, ""), c.SetModifiedCell(b), c.o.autoSave && c.SubmitAll()
            }
        }
    }, AddNewRow: function() {
        var a, b = this.o.startRow;
        "bottom" === this.o.newRowPos ? b = -1 : "number" == typeof this.o.newRowPos && this.o.newRowPos >= -1 && (b = this.o.newRowPos);
        try {
            a = this.o.table.insertRow(b)
        } catch (c) {
            a = this.o.table.insertRow(this.o.startRow), console.log(c)
        }
        a.setAttribute("id", this.o.CreateId()), this.o.Css.Add(a, this.o.newRowClass);
        for (var d = 0; d < this.o.nbCells; d++) {
            var e = a.insertCell(d);
            e.innerHTML = this.o.defaultRecord ? this.o.defaultRecord[d] : this.o.defaultRecordUndefinedValue
        }
        this.o.cmdInsertBtnScroll && a.scrollIntoView(!1), this.newRows.push(a), this.o.onAddedDomRow && this.o.onAddedDomRow.call(null, this.o, this.newRows, a)
    }, SubmitEditedRows: function() {
        this.Submit("update")
    }, SubmitAddedRows: function() {
        this.SetRowsObject(this.newRows, "insert"), this.Submit("insert")
    }, SubmitDeletedRows: function() {
        if (this.o.selection) {
            if (!this.o.Selection.activeRow && 0 === this.o.Selection.selectedRows.length)
                return;
            var a = this.o.bulkDelete ? this.o.Selection.selectedRows : [this.o.Selection.activeRow];
            if (0 === a.length)
                return;
            this.SetRowsObject(a, "delete"), confirm(this.o.msgConfirmDelSelectedRows) ? this.Submit("delete") : this.deletedRows = []
        }
    }, SubmitAll: function() {
        this.submitAll = !0, this.SubmitAddedRows(), this.SubmitEditedRows()
    }, AutoSubmit: function() {
        switch (this.o.autoSaveType) {
            case"both":
                this.SubmitAll();
                break;
            case"insert":
                this.SubmitAddedRows();
                break;
            case"update":
            default:
                this.SubmitEditedRows()
            }
    }, Submit: function(a) {
        function b(b) {
            if (n.o.savedRowsNb[a] === c.length) {
                if (c = [], n.o.savedRowsNb[a] = 0, "insert" == a)
                    n.o.Editable.newRows = [], n.o.Editable.addedRows = [];
                else if ("delete" == a) {
                    if (d) {
                        var f = n.o.Selection.GetActiveRow(), g = n.o.Selection.GetActiveCell(), h = null, j = null, k = null;
                        f && (h = f.rowIndex, k = h - 1 >= n.o.startRow ? h - 1 : n.o.startRow), g && (j = g.cellIndex), n.o.Selection.ClearSelections();
                        for (var l = [], m = 0; m < n.o.Editable.deletedRows.length; m++)
                            l.push(n.o.Editable.deletedRows[m][0]);
                        l.sort(n.o.Sort.NumDesc);
                        for (var m = 0; m < l.length; m++)
                            n.o.table.deleteRow(l[m]);
                        if (null !== k && n.o.Selection.SelectRowByIndex(k), null !== j && f) {
                            var o = f.cells[j];
                            n.o.Selection.SelectCell(o)
                        }
                    }
                    n.o.Editable.deletedRows = [], n.o.Editable.SetCommandEditor(n.o.editorCmdColIndex)
                } else
                    n.o.Editable.modifiedRows = [];
                0 === n.o.savedRowsNb.update && 0 === n.o.savedRowsNb.insert && 0 === n.o.savedRowsNb["delete"] && (i ? i.call(null, n.o, c) : b && !n.o.autoSave && (!n.o.Editable.submitAll || n.o.Editable.submitAll && "update" === a) && alert(n.o.msgSubmitOK), n.o.Editable.submitAll = !1), n.o.onServerActivityStop && n.o.onServerActivityStop.call(null, n.o, n.o.table.rows[q]), "form" === e && !n.o.ajax && n.o.ifrmContainer[a] && (n.o.ifrmContainer[a].innerHTML = ""), n.o.Css.Remove(n.o.table, n.o.activityIndicatorCss)
            }
        }
        a = a.LCase();
        var c, d, e, f, g, h, i, j, k, l, m, n = this;
        switch (a || "") {
            case"insert":
                c = this.GetAddedRows(), d = this.o.insertURI, e = this.o.insertSubmitMethod, f = this.o.insertFormMethod, g = this.o.insertParams, h = this.o.onBeforeInsertSubmit, i = this.o.onAfterInsertSubmit, j = this.o.onInsertSubmit, k = this.o.onInsertError, l = this.o.checkInsertResponseSanity, m = this.o.processInsertResponse;
                break;
            case"delete":
                c = this.GetDeletedRows(), d = this.o.deleteURI, e = this.o.deleteSubmitMethod, f = this.o.deleteFormMethod, g = this.o.deleteParams, h = this.o.onBeforeDeleteSubmit, i = this.o.onAfterDeleteSubmit, j = this.o.onDeleteSubmit, k = this.o.onDeleteError, l = this.o.checkDeleteResponseSanity, m = this.o.processDeleteResponse;
                break;
            case"update":
            default:
                c = this.GetModifiedRows(), d = this.o.updateURI, e = this.o.updateSubmitMethod, f = this.o.updateFormMethod, g = this.o.updateParams, h = this.o.onBeforeUpdateSubmit, i = this.o.onAfterUpdateSubmit, j = this.o.onUpdateSubmit, k = this.o.onUpdateError, l = this.o.checkUpdateResponseSanity, m = this.o.processUpdateResponse
        }
        if (h && h.call(null, this.o, c), j)
            j.call(null, this.o, c);
        else if ((!d || "" === d) && c.length > 0)
            alert(a.toUpperCase() + ": " + this.o.msgUndefinedSubmitUrl), c = [], n.o.savedRowsNb[a] = 0, b(!1);
        else {
            for (var o = 0; o < c.length; o++) {
                var p = c[o], q = p[0], r = p[1];
                if (!(0 > q)) {
                    var s = (r.values, r.urlParams), t = s.split("&"), u = this.o.table.rows[q].getAttribute("id");
                    if (g && this.o.IsArray(g)) {
                        for (var v = 0; v < g.length; v++)
                            "" !== g[v] && (s = s.replace(t[v + 1].split("=")[0], g[v]));
                        t = s.split("&")
                    }
                    if (this.o.Css.Add(this.o.table, this.o.activityIndicatorCss), this.o.onServerActivityStart && this.o.onServerActivityStart.call(null, this.o, this.o.table.rows[q]), "script" === e) {
                        var w = (-1 === d.indexOf("?") ? "?rowId=" : "&rowId=") + u + s;
                        try {
                            this.o.IncludeFile(this.o.prfxScr + q + "_" + this.o.id, d + w, function(c, d) {
                                c.savedRowsNb[a]++;
                                var e = d.id.replace(c.prfxScr, "").replace("_" + c.id, "");
                                c.Editable.RemoveModifiedCellMark(parseInt(e, 10)), b(!0)
                            })
                        } catch (x) {
                            this.o.Css.Remove(this.o.table, this.o.activityIndicatorCss), this.o.onServerActivityStop && this.o.onServerActivityStop.call(null, this.o, this.o.table.rows[q]), this.o.onSubmitError ? this.o.onSubmitError.call(null, this.o, x, x.description) : alert(this.o.msgErrOccur + "\n" + x.description + "\n" + this.o.msgSaveUnsuccess)
                        }
                    } else if ("script" !== e && this.o.ajax) {
                        (function(e, g, h, i) {
                            function j(b, c, e) {
                                var g = "rowId=" + b + "&rIndex=" + e + c;
                                $.ajax({url: d, type: f, data: g}).done(function(b, c, d) {
                                    var f = d.getResponseHeader("content-type") || "application/json";
                                    if (-1 !== f.indexOf("application/json")) {
                                        var g = k(b);
                                        g ? (m && m.call(r.o, b), b.result && b.result.id && "insert" === a && r.o.table.rows[e] && r.o.table.rows[e].setAttribute("id", r.o.newRowPrefix + b.result.id), p()) : o(null, "Invalid Data", r.o.msgInvalidData)
                                    } else
                                        q = r.o.CreateElm("div", ["id", "xhr_" + e + "_" + r.o.id]), document.body.appendChild(q), $(q).html(b), p()
                                }).always(function() {
                                    q && document.body.removeChild(q)
                                }).fail(o)
                            }
                            function k(a) {
                                return l ? l.call(r.o, a) : a && a.hasOwnProperty("result") && a.result.hasOwnProperty("success") && a.result.hasOwnProperty("id")
                            }
                            function o(b, d, f) {
                                "insert" === a && (r.o.Editable.addedRows.splice(g, 1), r.o.Editable.newRows.splice(g, 1)), c.splice(g, 1), r.o.Css.Remove(r.o.table, r.o.activityIndicatorCss), r.o.onServerActivityStop && r.o.onServerActivityStop.call(null, r.o, r.o.table.rows[e]), r.o.onSubmitError ? r.o.onSubmitError.call(null, r.o, x, x.description) : alert(r.o.msgErrOccur + "\n" + f + "\n" + r.o.msgSaveUnsuccess)
                            }
                            function p() {
                                r.o.savedRowsNb[a]++, r.o.Editable.RemoveModifiedCellMark(e), r.o.Css.Remove(r.o.table.rows[e], r.o.newRowClass), b(!0)
                            }
                            var q, r = this;
                            0 === g ? j(h, i, e, g) : setTimeout(function() {
                                j(h, i, e, g)
                            }, g * n.o.formSubmitInterval)
                        }).call(this, q, o, u, s)
                    } else {
                        this.o.ifrmContainer[a] || (this.o.ifrmContainer[a] = this.o.CreateElm("div", ["id", "cont_" + this.o.id + a], ["style", "display:none;"]));
                        var y, z = this.o.prfxIFrm + q + "_" + this.o.id + a;
                        try {
                            var y = document.createElement('<iframe src="about:blank" name="' + z + '" id="' + z + '" ' + this.o.attrRowIndex + '="' + q + '"></iframe>')
                        } catch (x) {
                            var y = this.o.CreateElm("iframe", ["id", z], ["name", z], ["src", "about:blank"], [this.o.attrRowIndex, q])
                        }
                        y.style.cssText = "display:none; width:0; height:0;";
                        for (var A = this.o.CreateElm("form", ["id", this.o.prfxFrm + q + "_" + this.o.id + a], ["method", f], ["action", d], ["target", z], ["accept-charset", "utf-8"]), v = 1; v < t.length; v++) {
                            var B = t[v].split("=")[0], C = t[v].split("=")[1], D = this.o.CreateElm("input", ["type", "hidden"], ["name", B], ["value", C]);
                            A.appendChild(D)
                        }
                        var D = this.o.CreateElm("input", ["type", "hidden"], ["name", "rowId"], ["value", u]);
                        A.appendChild(D), document.body.appendChild(this.o.ifrmContainer[a]), this.o.ifrmContainer[a].appendChild(y), this.o.ifrmContainer[a].appendChild(A)
                    }
                }
            }
            if (c.length > 0 && this.o.ifrmContainer[a])
                for (var E = this.o.Tag(this.o.ifrmContainer[a], "iframe"), F = this.o.Tag(this.o.ifrmContainer[a], "form"), v = 0; v < E.length; v++)
                    !function(c) {
                        var d = F[c], e = E[c];
                        0 === c ? d.submit() : setTimeout(function() {
                            d.submit()
                        }, c * n.o.formSubmitInterval), e.onload = e.onreadystatechange = function() {
                            try {
                                var c = this.getAttribute(n.o.attrRowIndex), d = this.contentDocument || this.contentWindow && this.contentWindow.document;
                                if (d && "complete" === d.readyState)
                                    if ("about:blank" === d.location.href) {
                                        var e = n.o.Get(this.id.replace(n.o.prfxIFrm, n.o.prfxFrm));
                                        e && e.submit()
                                    } else
                                        n.o.savedRowsNb[a]++, n.o.Editable.RemoveModifiedCellMark(c), n.o.Css.Remove(n.o.table.rows[c], n.o.newRowClass), b(!0)
                            } catch (f) {
                                n.o.Css.Remove(n.o.table, n.o.activityIndicatorCss), n.o.onServerActivityStop && n.o.onServerActivityStop.call(null, n.o, n.o.table.rows[q]), k ? k.call(null, n.o, f, f.description) : alert(n.o.msgErrOccur + "\n" + f.description + "\n" + n.o.msgSaveUnsuccess)
                            }
                        }
                    }(v)
        }
    }, Edit: function(a) {
        var b, c;
        if (a && a.type && -1 !== a.type.LCase().indexOf("click"))
            b = this.o.GetRow(a), c = this.o.GetCell(a);
        else {
            if (!this.o.selection)
                return;
            if (!this.o.Selection.activeRow && !this.o.Selection.activeCell)
                return;
            b = this.o.Selection.activeRow, c = this.o.Selection.activeCell
        }
        if (b && !(b.rowIndex < this.o.startRow)) {
            if ("cell" === this.o.editorModel && c) {
                var d = c.cellIndex;
                !this.activeCellEditor && this.o.editors[d] && (this.o.IsEditorType(d, this.o.edtTypes.bool) ? this.SetCheckBoxValue(a, c) : this.OpenCellEditor(c))
            }
            "row" !== this.o.editorModel || this.IsRowEditorOpen() || this.OpenRowEditor(b)
        }
    }, Event: {OnInputFocus: function(a) {
            var b = this.o.Event.GetElement(a);
            b.select()
        }, OnBlur: function(a) {
            var b = this.o.Event.GetElement(a), c = b.getAttribute(this.o.attrColIndex);
            if (null === c) {
                var d = this.o.GetElement(a, "td");
                c = d.cellIndex
            }
            "cell" == this.o.editorModel && this.CloseCellEditor(c)
        }}}, Selection.prototype = {onClickAdded: !1, activeRow: null, activeCell: null, selectedRows: [], Init: function() {
        this.o.selection && (this.SetEvents(), this.o.selectRowAtStart && (this.SelectRowByIndex(this.o.rowIndexAtStart), this.activeRow && this.SelectCell(this.activeRow.cells[0])), this.o.onSelectionInit && this.o.onSelectionInit.call(null, this.o))
    }, Set: function() {
        this.o.selection = !0, this.o.keyNav = !0, this.SetEvents()
    }, Remove: function() {
        this.o.selection = !1, this.o.keyNav = !1, this.RemoveEvents()
    }, SetEvents: function() {
        if (!this.onClickAdded) {
            var a = this;
            this.o.Event.Bind(this.o.table, "click", function(b) {
                a.OnClick.call(a, b)
            }), (this.o.onValidateRow || this.o.onValidateCell) && this.o.Event.Bind(this.o.table, "dblclick", function(b) {
                a.OnDblClick.call(a, b)
            }), this.onClickAdded = !0
        }
        this.o.keyNav && this.o.Event.Bind(this.o.StandardBody(), "keydown", function(b) {
            a.OnKeyDown.call(a, b)
        })
    }, RemoveEvents: function() {
        if (this.onClickAdded) {
            var a = this;
            this.o.Event.Unbind(this.o.table, "click", function(b) {
                a.OnClick.call(a, b)
            }), (this.o.onValidateRow || this.o.onValidateCell) && this.o.Event.Unbind(this.o.table, "dblclick", function(b) {
                a.OnDblClick.call(a, b)
            }), this.o.Event.Unbind(this.o.StandardBody(), "keydown", function(b) {
                a.OnKeyDown.call(a, b)
            }), this.onClickAdded = !1
        }
    }, GetActiveRow: function() {
        return this.activeRow
    }, GetActiveCell: function() {
        return this.activeCell
    }, GetSelectedRows: function() {
        return this.selectedRows
    }, GetSelectedValues: function() {
        for (var a = [], b = 0; b < this.GetSelectedRows().length; b++) {
            var c = this.GetSelectedRows()[b], d = this.GetRowValues(c);
            a.push(d)
        }
        return a
    }, GetActiveRowValues: function() {
        return this.GetActiveRow() ? this.GetRowValues(this.GetActiveRow()) : []
    }, GetRowValues: function(a) {
        if (!a)
            return[];
        for (var b = [], c = 0; c < a.cells.length; c++) {
            var d = a.cells[c];
            b.push(this.o.GetText(d))
        }
        return b
    }, SelectRowByIndex: function(a) {
        (void 0 === a || isNaN(a)) && (a = 0);
        var b = this.o.table.rows[a];
        b && this.SelectRow(b)
    }, SelectRowsByIndexes: function(a) {
        if (this.o.IsArray(a))
            for (var b = 0; b < a.length; b++)
                this.SelectRowByIndex(a[b])
    }, SelectRow: function(a, b) {
        "cell" == this.o.defaultSelection || a.rowIndex < 0 || (this.o.onBeforeSelectedRow && this.o.onBeforeSelectedRow.call(null, this.o, a, b), this.o.Css.Remove(this.activeRow, this.o.activeRowCss), "multiple" === this.o.selectionModel && (this.o.Css.Add(a, this.o.selectedRowCss), -1 == this.selectedRows.indexOf(a) && this.selectedRows.push(a)), this.o.Css.Add(a, this.o.activeRowCss), this.activeRow = a, et_activeGrid = this.o.id, this.o.onAfterSelectedRow && this.o.onAfterSelectedRow.call(null, this.o, a, b))
    }, DeselectRow: function(a, b) {
        if ("cell" != this.o.defaultSelection && this.IsRowSelected(a)) {
            if (this.o.onBeforeDeselectedRow && this.o.onBeforeDeselectedRow.call(null, this.o, a, b), this.o.Css.Remove(a, this.o.activeRowCss), this.o.Css.Remove(a, this.o.selectedRowCss), "multiple" == this.o.selectionModel)
                for (var c = 0; c < this.GetSelectedRows().length; c++) {
                    var d = this.selectedRows[c];
                    if (a == d) {
                        this.selectedRows.splice(c, 1);
                        break
                    }
                }
            this.o.Css.Remove(this.activeRow, this.o.activeRowCss), this.activeRow = null, this.o.onAfterDeselectedRow && this.o.onAfterDeselectedRow.call(null, this.o, a, b)
        }
    }, SelectCell: function(a, b) {
        if ("row" != this.o.defaultSelection) {
            this.o.onBeforeSelectedCell && this.o.onBeforeSelectedCell.call(null, this.o, a, b), this.o.Css.Add(a, this.o.activeCellCss), this.activeCell = a;
            try {
                "cell" == this.o.defaultSelection && a.parentNode && "tr" == a.parentNode.nodeName.LCase() && (this.activeRow = a.parentNode)
            } catch (c) {
            }
            et_activeGrid = this.o.id, this.o.onAfterSelectedCell && this.o.onAfterSelectedCell.call(null, this.o, a, b)
        }
    }, DeselectCell: function(a, b) {
        "row" != this.o.defaultSelection && (this.o.onBeforeDeselectedCell && this.o.onBeforeDeselectedCell.call(null, this.o, a, b), this.IsCellSelected(a) && (this.o.Css.Remove(a, this.o.activeCellCss), this.activeCell = null, "cell" == this.o.defaultSelection && (this.activeRow = null)), this.o.onAfterDeselectedCell && this.o.onAfterDeselectedCell.call(null, this.o, a, b))
    }, ClearSelections: function() {
        var a = this.activeRow, b = this.activeCell;
        b && this.DeselectCell(b), a && this.DeselectRow(a);
        for (var c = 0; c < this.GetSelectedRows().length; c++) {
            var d = this.selectedRows[c];
            this.o.onBeforeDeselectedRow && this.o.onBeforeDeselectedRow.call(null, this.o, d), this.o.Css.Remove(d, this.o.selectedRowCss), this.o.Css.Remove(d, this.o.activeRowCss), this.o.onAfterDeselectedRow && this.o.onAfterDeselectedRow.call(null, this.o, d)
        }
        this.selectedRows = []
    }, IsRowSelected: function(a) {
        if ("single" == this.o.selectionModel)
            return a == this.activeRow;
        for (var b = 0; b < this.GetSelectedRows().length; b++) {
            var c = this.selectedRows[b];
            if (c == a)
                return!0
        }
        return!1
    }, IsCellSelected: function(a) {
        return a == this.activeCell
    }, OnDblClick: function(a) {
        {
            var b = this.o.GetRow(a);
            this.o.GetCell(a)
        }
        !b || b.rowIndex < this.o.startRow || this.o.editable || (this.o.onValidateRow && "cell" != this.o.defaultSelection && this.o.onValidateRow.call(null, this.o, this.activeRow), this.o.onValidateCell && "row" != this.o.defaultSelection && this.o.onValidateCell.call(null, this.o, this.activeCell))
    }, OnClick: function(a) {
        var b = this.o.GetRow(a), c = this.o.GetCell(a);
        if (b && !(b.rowIndex < this.o.startRow)) {
            if (this.o.autoSave && "row" === this.o.autoSaveModel && this.activeRow && this.activeRow.rowIndex !== b.rowIndex && this.o.Editable.AutoSubmit(), "single" == this.o.selectionModel)
                this.ClearSelections(), this.SelectRow(b), this.SelectCell(c);
            else {
                if (this.o.keySelection)
                    if (!this.o.keySelection || a.ctrlKey || a.shiftKey)
                        if (this.o.keySelection && a.ctrlKey && this.selectedRows.length > 0)
                            this.SelectRow(b);
                        else if (this.o.keySelection && a.shiftKey && this.selectedRows.length > 0) {
                            if (!this.activeRow)
                                return;
                            var d = this.activeRow.rowIndex;
                            this.SelectRow(b);
                            var e = this.activeRow.rowIndex;
                            if (e > d) {
                                for (var f = d + 1; e > f; f++) {
                                    var g = this.o.table.rows[f];
                                    g && (this.IsRowSelected(g) ? this.DeselectRow(g) : this.SelectRow(g))
                                }
                                this.IsRowSelected(this.o.table.rows[d + 1]) || this.DeselectRow(this.o.table.rows[d])
                            } else {
                                for (var f = d - 1; f > e; f--) {
                                    var g = this.o.table.rows[f];
                                    g && (this.IsRowSelected(g) ? this.DeselectRow(g) : this.SelectRow(g))
                                }
                                this.IsRowSelected(this.o.table.rows[d - 1]) || this.DeselectRow(this.o.table.rows[d])
                            }
                            this.SelectRow(b)
                        } else
                            this.SelectRow(b);
                    else
                        this.ClearSelections(), this.SelectRow(b);
                else
                    this.selectedRows.length > 0 ? this.IsRowSelected(b) ? this.DeselectRow(b) : this.SelectRow(b) : this.SelectRow(b);
                this.DeselectCell(this.activeCell), this.IsRowSelected(b) && this.SelectCell(c)
            }
            if (this.o.editable) {
                if ("cell" == this.o.editorModel) {
                    var h = this.o.Editable.activeCellEditor;
                    !h && c && this.o.editors[c.cellIndex] && this.o.IsEditorType(c.cellIndex, this.o.edtTypes.bool) && "dblclick" === this.o.openEditorAction && this.o.Editable.SetCheckBoxValue(a, c), h && (this.o.IsEditorType(h.cellIndex, this.o.edtTypes.custom) || this.o.IsEditorType(h.cellIndex, this.o.edtTypes.uploader)) && (c && c.cellIndex != h.cellIndex || b.rowIndex != h.parentNode.rowIndex) && this.o.Editable.CloseCellEditor(h.cellIndex)
                }
                "row" == this.o.editorModel && b != this.o.Editable.activeRow && this.o.Editable.CloseRowEditor()
            }
        }
    }, OnKeyDown: function(a) {
        function b() {
            j.o.editable && l.activeCellEditor && "cell" == j.o.editorModel && l.CloseCellEditor(l.activeCellEditor.cellIndex), j.o.editable && l.activeRow && "row" == j.o.editorModel && l.activeRow != j.activeRow && l.CloseRowEditor()
        }
        if (this.activeRow) {
            var c = this.o.GetTableFromElement(this.activeRow);
            if (c && "table" == c.nodeName.LCase() && c.id == et_activeGrid) {
                var d, e, f = this.o.Event.GetKey(a), g = this.o.table.rows.length - 1, h = this.o.GetCellsNb() - 1, i = this.activeRow.rowIndex, j = this, k = function(b) {
                    if (j.activeRow) {
                        var c = j.activeCell ? j.activeCell.cellIndex : 0;
                        "single" == j.o.selectionModel || "multiple" == j.o.selectionModel && !a.shiftKey || !j.o.keySelection ? j.ClearSelections() : "multiple" == j.o.selectionModel && a.shiftKey && j.DeselectCell(j.activeCell, a), e = c, "down" === b ? d = g > i ? i + 1 : g : "up" === b ? d = i == j.o.startRow ? j.o.startRow : i - 1 : "pgdown" === b ? d = i + j.o.nbRowsPerPage < g ? i + j.o.nbRowsPerPage : g : "pgup" === b ? d = i - j.o.nbRowsPerPage <= j.o.startRow ? j.o.startRow : i - j.o.nbRowsPerPage : "home" === b ? d = j.o.startRow : "end" === b ? d = g : "right" === b ? "row" != j.o.defaultSelection ? (d = i, e = c + 1 > h ? 0 : c + 1, c + 1 > h && (d = g > i ? i + 1 : g)) : d = g > i ? i + 1 : g : "left" === b && ("row" != j.o.defaultSelection ? (d = i, e = 0 > c - 1 ? h : c - 1, 0 > c - 1 && (d = i == j.o.startRow ? j.o.startRow : i - 1)) : d = i == j.o.startRow ? j.o.startRow : i - 1)
                    } else
                        d = j.o.startRow, e = 0;
                    var f = j.o.table.rows[d];
                    if (j.o.keySelection && a.shiftKey && j.selectedRows.length > 0 && ("pgdown" == b || "pgup" == b || "home" == b || "end" == b)) {
                        if (!j.activeRow)
                            return;
                        if (d > i) {
                            for (var k = i + 1; d > k; k++) {
                                var l = j.o.table.rows[k];
                                l && (j.IsRowSelected(l) ? j.DeselectRow(l, a) : j.SelectRow(l, a))
                            }
                            j.IsRowSelected(j.o.table.rows[i + 1]) || j.DeselectRow(j.o.table.rows[i], a)
                        } else {
                            for (var k = i - 1; k > d; k--) {
                                var l = j.o.table.rows[k];
                                l && (j.IsRowSelected(l) ? j.DeselectRow(l, a) : j.SelectRow(l, a))
                            }
                            j.IsRowSelected(j.o.table.rows[i - 1]) || j.DeselectRow(j.o.table.rows[i], a)
                        }
                        j.SelectRow(f, a)
                    } else
                        j.o.keySelection && a.shiftKey && j.IsRowSelected(f) && j.DeselectRow(j.o.table.rows[i], a), j.SelectRow(f, a);
                    if ("row" != j.o.defaultSelection) {
                        var m = f.cells[e];
                        j.SelectCell(m, a), j.o.scrollIntoView && m.scrollIntoView(!1)
                    }
                    j.o.scrollIntoView && "row" == j.o.defaultSelection && f.scrollIntoView(!1), j.o.autoSave && "row" === j.o.autoSaveModel && d !== i && j.o.Editable.AutoSubmit(), j.o.Event.Cancel(a)
                }, l = this.o.Editable;
                switch (f) {
                    case 40:
                        (!j.o.editable || j.o.editable && !l.activeCellEditor && !l.activeRow) && k("down");
                        break;
                    case 38:
                        (!j.o.editable || j.o.editable && !l.activeCellEditor && !l.activeRow) && k("up");
                        break;
                    case 37:
                        (!j.o.editable || j.o.editable && !l.activeCellEditor && !l.activeRow) && k("left");
                        break;
                    case 39:
                        (!j.o.editable || j.o.editable && !l.activeCellEditor && !l.activeRow) && k("right");
                        break;
                    case 34:
                        k("pgdown"), b();
                        break;
                    case 33:
                        k("pgup"), b();
                        break;
                    case 36:
                        k("home"), b();
                        break;
                    case 35:
                        k("end"), b();
                        break;
                    case 9:
                        k(a.shiftKey ? "left" : "right"), "row" == j.o.editorModel ? (j.activeCell && "row" != j.selectionModel && l.SetEditorFocus(j.activeCell.cellIndex), j.activeRow && l.activeRow && j.activeRow.rowIndex != l.activeRow.rowIndex && b()) : b();
                        break;
                    case 13:
                        j.o.editable ? l.activeCellEditor ? j.o.IsEditorType(l.activeCellEditor.cellIndex, j.o.edtTypes.input) && b() : (l.Edit.call(l, a), j.o.Event.Cancel(a)) : j.o.onValidateRow || j.o.onValidateCell ? (j.o.onValidateRow && "cell" != j.o.defaultSelection && j.o.onValidateRow.call(null, j.o, j.activeRow), j.o.onValidateCell && "row" != j.o.defaultSelection && j.o.onValidateCell.call(null, j.o, j.activeCell)) : k("down");
                        break;
                    case 113:
                    case 32:
                        j.o.editable && !l.activeCellEditor && (l.Edit.call(l, a), j.o.Event.Cancel(a));
                        break;
                    case 45:
                        j.o.editable && !l.activeCellEditor && (l.AddNewRow(), l.SetCommandEditor(j.o.editorCmdColIndex), j.o.Event.Cancel(a));
                        break;
                    case 46:
                        j.o.editable && !l.activeCellEditor && (l.SubmitDeletedRows(), j.o.Event.Cancel(a));
                        break;
                    case 27:
                        j.o.editable && "cell" == j.o.editorModel && l.activeCellEditor && b(), j.o.editable && "row" == j.o.editorModel && b();
                        break;
                    default:
                        j.o.editable && j.o.editableOnKeystroke && "cell" == j.o.editorModel && "single" == j.o.selectionModel && !l.activeCellEditor && !l.activeRow && (l.Edit.call(l, a), j.o.Event.Cancel(a))
                }
                j.o.editable && "click" == j.o.openEditorAction && l.Edit.call(l, a)
            }
        }
    }}, EditTable.prototype = {Init: function() {
        this.Css.Add(this.table, this.tableCss + " " + this.unselectableCss), this.Selection.Init(), this.Editable.Init()
    }, GetCellsNb: function(a) {
        var b = void 0 === a ? this.table.rows[this.startRow] : this.table.rows[a];
        return b.cells.length
    }, GetRowsNb: function() {
        return this.table.rows.length
    }, GetRow: function(a) {
        return this.GetElement(a, "tr")
    }, GetRowByIndex: function(a) {
        return this.table.rows[a]
    }, GetCell: function(a) {
        return this.GetElement(a, "td") || this.GetElement(a, "th")
    }, GetTableFromElement: function(a) {
        if (!a)
            return null;
        for (; a.parentNode; ) {
            if ("TABLE" === a.nodeName.UCase())
                return a;
            a = a.parentNode
        }
        return null
    }, GetElement: function(a, b) {
        for (var c, d = this.Event.GetElement(a); d.parentNode; ) {
            if (d.nodeName.UCase() === b.UCase() && this.IsParentValid(d)) {
                c = d;
                break
            }
            d = d.parentNode
        }
        return c
    }, IsParentValid: function(a) {
        for (; a.parentNode; ) {
            if ("TABLE" === a.nodeName.UCase())
                return a.id == this.id ? !0 : !1;
            a = a.parentNode
        }
        return!1
    }, IsSelectable: function() {
        return this.selection
    }, IsEditable: function() {
        return this.editable
    }, ClearSelections: function() {
        this.Selection.ClearSelections()
    }, IsEditorType: function(a, b) {
        return this.editorTypes[a] === b
    }, IsObj: function(a) {
        return a && a.constructor == Object
    }, IsFn: function(a) {
        return a && a.constructor == Function
    }, IsArray: function(a) {
        return a && a.constructor == Array
    }, Get: function(a) {
        return document.getElementById(a)
    }, Tag: function(a, b) {
        return a ? a.getElementsByTagName(b) : null
    }, GetText: function(a) {
        if (!a)
            return"";
        var b = a.textContent || a.innerText || a.innerHTML.replace(/\<[^<>]+>/g, "");
        return b.replace(/^\s+/, "").replace(/\s+$/, "").Trim()
    }, CreateElm: function(a) {
        if (void 0 !== a && null !== a && "" !== a) {
            var b = document.createElement(a);
            if (arguments.length > 1)
                for (var c = 0; c < arguments.length; c++) {
                    var d = typeof arguments[c];
                    "object" == d.LCase() && 2 == arguments[c].length && b.setAttribute(arguments[c][0], arguments[c][1])
                }
            return b
        }
    }, CreateText: function(a) {
        return document.createTextNode(a)
    }, CreateId: function(a) {
        return(a || this.newRowPrefix) + (new Date).getTime()
    }, StandardBody: function() {
        return"CSS1Compat" == document.compatMode ? document.documentElement : document.body
    }, Css: {Has: function(a, b) {
            return a ? a.className.match(new RegExp("(\\s|^)" + b + "(\\s|$)")) : !1
        }, Add: function(a, b) {
            a && (this.Has(a, b) || (a.className += " " + b))
        }, Remove: function(a, b) {
            if (a && this.Has(a, b)) {
                var c = new RegExp("(\\s|^)" + b + "(\\s|$)");
                a.className = a.className.replace(c, "")
            }
        }}, Event: {evt: {}, Bind: function(a, b, c) {
            a in this.evt || (this.evt[a] = {}), b in this.evt[a] || (this.evt[a][b] = []), this.evt[a][b].push([c, !0]), this.Add(a, b, c)
        }, Unbind: function(a, b, c) {
            if (a in this.evt) {
                var d = this.evt[a];
                if (b in d)
                    for (var e = d[b], f = e.length; f--; ) {
                        var g = e[f];
                        g[0].toString() == c.toString() && this.Remove(a, b, g[0])
                    }
            }
        }, Add: function(a, b, c, d) {
            a.attachEvent ? a.attachEvent("on" + b, c) : a.addEventListener ? a.addEventListener(b, c, void 0 === d ? !1 : d) : a["on" + b] = c
        }, Remove: function(a, b, c, d) {
            a.detachEvent ? a.detachEvent("on" + b, c) : a.removeEventListener ? a.removeEventListener(b, c, void 0 === d ? !1 : d) : a["on" + b] = null
        }, Get: function(a) {
            return a || window.event
        }, GetElement: function(a) {
            return a && a.target || event && event.srcElement
        }, GetKey: function(a) {
            var b = this.Get(a), c = b.charCode ? b.charCode : b.keyCode ? b.keyCode : b.which ? b.which : 0;
            return c
        }, Stop: function(a) {
            var b = this.Get(a);
            b.stopPropagation ? b.stopPropagation() : b.cancelBubble = !0
        }, Cancel: function(a) {
            var b = this.Get(a);
            b.preventDefault ? b.preventDefault() : b.returnValue = !1
        }}, IncludeFile: function(a, b, c, d) {
        var e, f = void 0 === d ? "script" : d, g = this, h = !1, i = this.Tag(document, "head")[0];
        e = "link" == f.LCase() ? this.CreateElm("link", ["id", a], ["type", "text/css"], ["rel", "stylesheet"], ["href", b]) : this.CreateElm("script", ["id", a], ["type", "text/javascript"], ["src", b]), e.onload = e.onreadystatechange = function() {
            h || this.readyState && "loaded" != this.readyState && "complete" != this.readyState || (h = !0, "function" == typeof c && (i.removeChild(e), c.call(null, g, this)))
        }, i.appendChild(e)
    }, Sort: {NumAsc: function(a, b) {
            return a - b
        }, NumDesc: function(a, b) {
            return b - a
        }, IgnoreCase: function(a, b) {
            var c = a.LCase(), d = b.LCase();
            return d > c ? -1 : c > d ? 1 : 0
        }}}, "undefined" == typeof String.prototype.LCase && (String.prototype.LCase = function() {
    return this.toLowerCase()
}), "undefined" == typeof String.prototype.UCase && (String.prototype.UCase = function() {
    return this.toUpperCase()
}), "undefined" == typeof String.prototype.Trim && (String.prototype.Trim = function() {
    return this.replace(/(^[\s\xA0]*)|([\s\xA0]*$)/g, "")
}), "undefined" == typeof String.prototype.RegexpEscape && (String.prototype.RegexpEscape = function() {
    function b(b) {
        a = new RegExp("\\" + b, "g"), c = c.replace(a, "\\" + b)
    }
    var c = this;
    chars = new Array("\\", "[", "^", "$", ".", "|", "?", "*", "+", "(", ")", "ï¿½");
    for (var d = 0; d < chars.length; d++)
        b(chars[d]);
    return c
}), "undefined" == typeof Array.prototype.indexOf && (Array.prototype.indexOf = function(a, b) {
    for (var c = b || 0, d = this.length; d > c; c++)
        if (this[c] === a)
            return c;
    return-1
});