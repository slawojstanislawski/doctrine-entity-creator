function createAssociationRow(html, target) {
    var div = $('<div class="removable"></div>');
    div.html(html);
    $(target).parent().parent().after(div);
}

function buildBootstrapFormGroupDiv(content) {
    return '<div class="form-group">' + content + '</div>';
}
function buildBootstrapLabelDiv(content) {
    return '<div class="col-sm-3">' + content + '</div>';
}
function buildBootstrapInputDiv(content) {
    return '<div class="col-sm-9">' + content + '</div>';
}

function createCascadeSelectMenu(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="cascade">Cascade:</label>') +
            buildBootstrapInputDiv(
                '<select class="form-control cascade" name="entityProperties[' + columnCount + '][cascade]" value="Application\\Entity\\">' +
                '<option value="0" selected></option>' +
                '<option value="{&quot;persist&quot;}">persist</option>' +
                '<option value="{&quot;merge&quot;}">merge</option>' +
                '<option value="{&quot;detach&quot;}">detach</option>' +
                '<option value="{&quot;remove&quot;}">remove</option>' +
                '<option value="{&quot;refresh&quot;}">refresh</option>' +
                '<option value="{&quot;persist&quot;, &quot;merge&quot;}">persist, merge</option>' +
                '<option value="{&quot;persist&quot;, &quot;remove&quot;}">persist, remove</option>' +
                '<option value="{&quot;persist&quot;, &quot;merge&quot;, &quot;remove&quot;}">persist, merge, remove</option>' +
                '<option value="{&quot;all&quot;}">all</option>' +
                '</select>'
            )
        ), target
    );
}
function createMapsRow(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="map">Mapped by: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control map" required name="entityProperties[' + columnCount + '][map]" type="text"></input>'
            )
        ), target
    );
}
function createInversedByRow(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="inverse">Inversed by: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control inverse" required name="entityProperties[' + columnCount + '][inverse]" type="text"></input></td>'
            )
        ), target
    );
}
function createTargetEntityRow(columnCount, target) {
    var entityNamespaceValue = $('#entityNamespace').val();
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="targetEntity">Target Entity: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control targetEntity" required name="entityProperties[' + columnCount + '][targetEntity]" type="text" value="' + entityNamespaceValue + '"></input>'
            )
        ), target
    );
}
function createIndexedByRow(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="indexBy">IndexBy:</label>') +
            buildBootstrapInputDiv(
                '<input class="form-control indexBy" name="entityProperties[' + columnCount + '][indexBy]" type="text" value=""></input>'
            )
        ), target
    );
}
function createJoinColumn1Row(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="joincolumns1">Join Col.1: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control joinColumn1" required name="entityProperties[' + columnCount + '][joinColumn1]" type="text"></input>'
            )
        ), target
    );
}
function createRefColumn1Row(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label  for="refcolumns1">Ref. Col.1: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input required class="form-control refColumn1"  name="entityProperties[' + columnCount + '][refColumn1]" type="text"></input>'
            )
        ), target
    );
}
function createJoinColumn2Row(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label  for="joincolumns2">Join Col.2: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control joinColumn2" required name="entityProperties[' + columnCount + '][joinColumn2]" type="text"></input>'
            )
        ), target
    );
}
function createRefColumn2Row(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label  for="refcolumns2">Ref. Col.2: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input required class="form-control refColumn2" name="entityProperties[' + columnCount + '][refColumn2]" type="text"></input>'
            )
        ), target
    );
}
function createJoinTableRow(columnCount, target) {
    createAssociationRow(
        buildBootstrapFormGroupDiv(
            buildBootstrapLabelDiv('<label for="jointables">Join Table: <span class="asteriskSpan">*</span></label>') +
            buildBootstrapInputDiv(
                '<input class="form-control joinTable" required name="entityProperties[' + columnCount + '][joinTable]" type="text"></input>'
            )
        ), target
    );
}
function updateAssociation(target) {

    //don't allow setting association on a property marked 'primary'
    if(target.parents("fieldset").find(".primaryCheckbox").prop("checked")) {
        target.popover({content : "Cannot set an association on primary property.", trigger : "manual", placement: "auto"});
        target.val(0);
        target.popover("show");
        setTimeout(function() {
            target.popover("hide");
        }, 2000);
        return;
    }

    var option = target.val();
    var currentFieldset = target.parents('fieldset');
    var classRows = currentFieldset.find('.removable');
    classRows.remove();
    var currentFieldsetIndex = findNumberInIdAttribute(currentFieldset);
    if (option == 1) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 2) {
        createMapsRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 3) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createInversedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 4) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn2Row(currentFieldsetIndex, target);
        createJoinColumn2Row(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createJoinTableRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 5) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createMapsRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 6) {
        createInversedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 7) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 8) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 9) {
        createMapsRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 10) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createInversedByRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 11) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 12) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createMapsRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 13) {
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createInversedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    } else if (option == 14) {
        createCascadeSelectMenu(currentFieldsetIndex, target);
        createRefColumn2Row(currentFieldsetIndex, target);
        createJoinColumn2Row(currentFieldsetIndex, target);
        createRefColumn1Row(currentFieldsetIndex, target);
        createJoinColumn1Row(currentFieldsetIndex, target);
        createJoinTableRow(currentFieldsetIndex, target);
        createIndexedByRow(currentFieldsetIndex, target);
        createTargetEntityRow(currentFieldsetIndex, target);
    }
}

function findNumberInIdAttribute(element) {
    return $(element).attr('id').match(/\d+$/)[0];
}

function findHighestIdNumberFromElements(elements) {
    var arrayOfIds = [];
    elements.each(function () {
        arrayOfIds.push(findNumberInIdAttribute($(this)));
    });
    return Math.max.apply(null, arrayOfIds);
}

$(document).ready(function () {
    var body = $("body");
    var entityForm = $('#entityForm');
    var ajaxLoading = $("#ajaxLoading");

    bindAjaxRequestToGif();

    function bindAjaxRequestToGif() {
        $(document).bind("ajaxStart.mine", function() {
            ajaxLoading.show();
        });
        $(document).bind("ajaxStop.mine", function() {
            ajaxLoading.hide();
        });
    }

    /******** HIDE ALL THE ALERTS. ***********/
    body.on('click', '.alert .close', function () {
        $(this).parent().hide();
    });

    /******** CHANGES IN ASSOCIATION ON SINGLE PROPERTY ***********/
    body.on("change", ".associationSelect", function () {
        var target = $(this);
        updateAssociation(target);
    });

    /******** ASSURING ONLY ONE PRIMARY IS CHECKED ***********/
    entityForm.find('.primaryCheckbox').prop('checked', true);
    entityForm.on('click', '.primaryCheckbox', function (event) {
        //do not allow marking property as 'primary' if an association is set on it.
        if($(this).parents("fieldset").find(".associationSelect").val() != 0 ) {
            event.preventDefault();
            event.stopPropagation();
            var element = $(this);
            element.popover({content : "Cannot mark a property as 'primary' if an association is set on it.", trigger : "manual", placement: "auto"});
            element.val(0);
            element.popover("show");
            setTimeout(function() {
                element.popover("hide");
            }, 2000);
            return;
        }
        $('.primaryCheckbox').prop('checked', false);
        $(this).prop('checked', true);
        var strategySelect = $('#strategySelect').detach();
        var selectedOption = ( strategySelect.find('option:selected').val());
        strategySelect.find('option[value="' + selectedOption + '"]').prop("selected", true);
        var currentFieldsetIdNumber = findNumberInIdAttribute($(this).parents('fieldset'));
        var strategySelectInnerHtmlCorrected = strategySelect.html().replace(/\[\d+\]/g, '[' + currentFieldsetIdNumber + ']');
        strategySelect.html(strategySelectInnerHtmlCorrected);
        strategySelect.find('option[value="' + selectedOption + '"]').prop("selected", true);
        $(this).parents('.form-group').append(strategySelect);
    });

    /******** INDEX ADDING ***********/
    function addIndex() {
        var indexContainers = $('form').find('.indexContainer');
        var highestId = findHighestIdNumberFromElements(indexContainers);
        var clonedIndexContainer = indexContainers.eq(0).clone();
        var nextId = highestId + 1;
        clonedIndexContainer.attr('id', 'indCont' + nextId);
        var template = clonedIndexContainer.html().replace(/\[\d\]/g, '[' + nextId + ']');
        clonedIndexContainer.html(template);
        indexContainers.last().after(clonedIndexContainer);
    }

    entityForm.on('click', '.indexPlusButton', function () {
        addIndex();
    });

    /******** INDEX REMOVING ***********/
    entityForm.on('click', '.indexMinusButton', function () {
        if ($('.indexContainer').length != 1) {
            $(this).parents('.indexContainer').remove();
        }
    });

    /******** PROPERTY ADDING ***********/
    function addProperty() {
        var fieldsets = $('form').find('fieldset');
        var highestIdNumber = findHighestIdNumberFromElements(fieldsets);
        var highestIdPlusOne = highestIdNumber + 1;
        var template = fieldsets.eq(0).clone();
        template.attr('id', "propertyFieldset" + highestIdPlusOne);
        var templateInnerHtmlCorrected = template.html().replace(/\[\d+\]/g, '[' + highestIdPlusOne + ']');
        template.html(templateInnerHtmlCorrected);
        template.find('.primaryCheckbox').prop('checked', false);
        template.find('#strategySelect').remove();
        template.find('.removable').remove();
        fieldsets.last().after(template);
        return true;
    }

    $('#addEntityProperty').click(function (e) {
        e.preventDefault();
        addProperty();
    });

    /******** PROPERTY REMOVING ***********/
    entityForm.on('click', '.removePropertyButton', function () {
        var fieldsets = entityForm.find('fieldset');
        if (fieldsets.length != 1) {
            var parentFieldset = $(this).parents('fieldset');
            var primaryCheckbox = parentFieldset.find('.primaryCheckbox');
            if (primaryCheckbox.prop('checked')) {
                $(this).popover('show');
            } else {
                $(this).parents('fieldset').remove();
            }
        }
    });

    /******** HANDLING FORM SUBMISSION ***********/
    entityForm.submit(function (event) {
        event.preventDefault();
    });

    function validateSchemaCreationAttempt() {
        var schemaFields = $("#dbname, #user, #password, #entityFilesNamespace, #driver");
        var allFieldsFilled = true;
        schemaFields.each(function () {
            if ($(this).val().trim() == "") {
                allFieldsFilled = false;
                return false;
            }
        });
        return allFieldsFilled;
    }

    entityForm.on("click", 'input[type="submit"]', function () {
        $('.alert').hide();
        $("html, body").animate({scrollTop: 0}, "fast");
        var clickedButton = $(this);
        var buttonId = clickedButton.attr('id');
        if (buttonId == "createSchema" || buttonId == "getSchemaSql") {
            if (!validateSchemaCreationAttempt()) {
                var resultDiv = $("#result");
                resultDiv.css("padding", "0px");
                resultDiv.html('');
                $("#dbFieldsNotFilled").show();
                return false;
            }
        }
        var baseUrl = window.location.href;
        var requestUrl = baseUrl + buttonId;
        var data = entityForm.serialize();
        makeAjaxRequest(requestUrl, data);
    });

    function makeAjaxRequest(requestUrl, data) {
        var resultDiv = $("#result");
        resultDiv.css("padding", "0px");
        resultDiv.html('');
        $.ajax({
            url: requestUrl,
            type: "post",
            data: data,
            dataType: "JSON",
            success: function (data) {
                if (data.status == "success") {
                    switch (data.action) {
                        case "getEntityString":
                            resultDiv.html(data.entityString);
                            resultDiv.css("padding", "0px 20px");
                            break;
                        case "saveFile":
                            $("#fileSaved").show();
                            break;
                        case "createSchema":
                            $("#dbSchemaCreated").show();
                            break;
                        case "getSchemaSql":
                            resultDiv.html(data.schemaSQL);
                            resultDiv.css("padding", "20px");
                            break;
                        case "jsonSelectMenu":
                            var jsonSelectMenu = $("#jsonSelectMenu");
                            if(jsonSelectMenu.children().length != data.classnames.length) {
                                jsonSelectMenu.html("");
                                $.each(data.classnames, function() {
                                    jsonSelectMenu.append($("<option />").val(this).text(this));
                                });
                            }
                            break;
                        case "populateForm":
                            var entityData = JSON.parse(data.json);
                            $("#entityNamespace").val(entityData.namespace);
                            $("#entityClassname").val(entityData.classname);
                            $("#entityTablename").val(entityData.tablename);
                            $("#entityRepoClass").val(entityData.repositoryclass);
                            populateIndexInputs(entityData.indexes);
                            populateEntityPropertyFieldsets(entityData.entityProperties);
                            $("#formPopulated").show();
                            break;
                    }
                } else {
                    switch (data.message) {
                        case "invalidform" :
                            $("#requiredMissing").show();
                            break;
                        case "duplicatePropertyNames" :
                            $("#duplicatePropertyNames").show();
                            break;
                        case "stringnotcreated" :
                            $("#stringNotCreated").show();
                            break;
                        case "didntcreatefolder" :
                            $("#folderNotCreated").show();
                            break;
                        case "notsaved" :
                            $("#fileNotSaved").show();
                            break;
                        case "noaccess" :
                            $("#dbAccessIncorrect").show();
                            break;
                        case "dberror" :
                            var alertMessage = $("#dbError");
                            alertMessage.find(".errorSpan").remove();
                            var errorSpan1 = $('<span class="errorSpan"><br/> Error message: ' + data.errmessage + "</span>");
                            if(data.errcode !== undefined) {
                                var errorSpan2 = $('<span class="errorSpan"><br/> Error code: ' + data.errcode + "</span>");
                            }
                            alertMessage.append(errorSpan1).append(errorSpan2);
                            alertMessage.show();
                            break;
                        case "nofiles" :
                            $("#NoEntityFiles").show();
                            break;
                        case "sqlstringfailed" :
                            $("#SqlStringNotCreated").show();
                            break;
                        case "noEntityFiles" :
                            //do nothing special for this case, no error, just no entity files present.
                            break;
                        case "didntPopulate" :
                            $("#JsonNotLoaded").show();
                            break;
                        default :
                            $("#defaultError").show();
                            break;
                    }
                }
            },//end of success property
            error: function () {
                $("#ajaxError").show();
            }
        });//end of ajax call
    }

    $("#jsonSelectMenu").focus(function() {
        var jsonSelectMenu = $(this);
        var baseUrl = window.location.href;
        var requestUrl = baseUrl + "jsonSelectMenu";
        var data = {};
        $(document).unbind(".mine");
        makeAjaxRequest(requestUrl, data);
        bindAjaxRequestToGif();
    });//end of click handler

    $("#populateForm").click(function () {
        $('.alert').hide();
        $("html, body").animate({scrollTop: 0}, "fast");
        var baseUrl = window.location.href;
        var requestUrl = baseUrl + "populateForm";
        var fileSelected = $("#jsonSelectMenu").find("option:selected").val();
        if(fileSelected !== undefined && fileSelected !== "") {
            var data = {};
            data.classname = fileSelected;
            makeAjaxRequest(requestUrl, data);
        } else {//end of if fileSelected empty
            $("#NoEntityFileSaved").show();
        }
    }); //end of on button click

    function getHighestKeyFromObject(object) {
        var keys = [];
        $.each(object, function (index) {
            keys.push(index);
        });
        return Math.max.apply(null, keys);
    }

    function populateIndexInputs(indexFieldsData) {
        var highestKey = getHighestKeyFromObject(indexFieldsData);
        $.each(indexFieldsData, function (index, singleIndexObject) {
            var currentIndexContainer = $(".indexContainer").last();
            currentIndexContainer.find(".indexInput").val(singleIndexObject.index);
            currentIndexContainer.find(".columnsInput").val(singleIndexObject.columns);
            if (index != highestKey) {
                currentIndexContainer.find(".indexPlusButton").trigger("click");
            }
        });
    }

    function populateEntityPropertyFieldsets(entityProperties) {
        $(".entityPropertyFieldset").not(':first').remove();

        var checkboxes = ["nullable", "unique", "unsigned", "primary"];
        var textInputsAndSelectMenus = ["propertyName", "strategy", "column", "columnType", "default", "cascade", "map", "inverse", "targetEntity", "indexBy", "joinColumn1", "joinColumn2", "refColumn1", "refColumn2", "joinTable"];
        var highestKey = getHighestKeyFromObject(entityProperties);

        $.each(entityProperties, function (index, entityProperty) {
            var currentPropertyFieldset = $(".entityPropertyFieldset").last();
            //IF ASSOCIATIONS ARE PRESENT, CREATE INPUTS TO POPULATE
            if (entityProperty.association != 0) {
                var associationSelect = currentPropertyFieldset.find(".associationSelect");
                associationSelect.val(entityProperty.association);
                updateAssociation(associationSelect);
            }
            //POPULATE CHECKBOXES, AND TEXT/SELECT INPUTS.
            $.each(entityProperty, function (key, value) {
                var classname = "." + key;
                if ($.inArray(key, checkboxes) > -1) {
                    if (value == 1) {
                        currentPropertyFieldset.find(classname).prop('checked', true)
                    }
                } else if ($.inArray(key, textInputsAndSelectMenus) > -1) {
                    if (!value) value = "";
                    currentPropertyFieldset.find(classname).val(value);
                }
            });
            //if not last entity property, add one more fieldset to populate in next iteration.
            if (index != highestKey) {
                $("#addEntityProperty").trigger("click");
            }

        });//end of for each entityProperties.
    }//end of populateEntityPropertyFieldsets()

}); //end of on document ready









