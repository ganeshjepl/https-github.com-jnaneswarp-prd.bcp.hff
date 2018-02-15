function switchView(){
    if(document.getElementById('primary').style.display==='none'){
        $('#new_reg').hide();
        $('#primary').show();
        $("#next").prop('value', 'Next');
    }
    else{
        $('#new_reg').show();
        $('#primary').hide();
        $("#next").prop('value', 'Previous');
    }
}

   
   

$(document).ready(function () {  
       
    $.ajax({
        url: site_url + 'api/mobile/v1/PrimaryAssessment/index',
        type: 'GET',
        success: function (data) {
            ///console.log(data);
            
            var questions = data.response.primaryAssessmentData[0].questionnaire.questions;
            var groupQuestionIds = data.response.primaryAssessmentData[0].questionnaire.groupQuestionIds;
            var qtnLength = Object.keys(questions).length;
            
           
            var questionnaire = "";           
            var nextSurveyTaxonomyId = "";
            var tempTaxonomyId = "";
            var curTaxonomyId = "";
            var curTaxonomyName = "";
            var curQuestionId = "";
            var curQuestion = "";
            var curSeverity = "";
            var curChiefComplaintLinking = "";
            
            
            var curOptions = [];            
            var curQuestionConditions = [];
            var curOptionLinkingCondQtns = []; 
            var allQuestionsConditions = []; 
            var allQuestionsConditionsList = [];
            var allLinkingConditionalQuestions = [];
            var linkedQtnId=[];
            
            
            var conditionalQstIdsByGroup = [];
            var allConditionalQtnIdsByGroup = [];
            var autoPopulateOptArray = [];
            var validationTypeArray=[];
            var allQuestions=[];
            
            var reg_numbers=/^[^\s][0-9]*$/;
            
            for (var i = 0; i < qtnLength; i++) {
                
                if(i < qtnLength - 1){
                    var j = i + 1;
                    nextSurveyTaxonomyId = questions[j].surveyTaxonomyId;
                }
                
                curTaxonomyId = questions[i].surveyTaxonomyId;
                curQuestionId = questions[i].id;
                curQuestion = questions[i].title;
                curSeverity = questions[i].severity;
                allQuestions.push(curQuestionId);
                if(questions[i].options !==undefined){
                   curOptions = questions[i].options; 
                }
                else{
                   curOptions =""; 
                }
                
                
                
                curChiefComplaintLinking = questions[i].chiefComplaintLinking; 
                
                //allQuestionsConditions[i] = "";  
                //allLinkingConditionalQuestions[i] = "";
               // console.log(questions[i].conditions);
                if (questions[i].conditions !== undefined) {                     
                    curQuestionConditions = questions[i].conditions; 
                    allQuestionsConditions[i] = questions[i].conditions; 
                   // console.log(allQuestionsConditions[i]);
                    
                    if(curQuestionConditions.length > 0){
                        var newKey = "";
                        $.each( questions[i].conditions, function( key, value ) {
                            newKey = value['displaySurveyQuestionId']; 
                                                     
                        });
                        
                        if(newKey !== "" && newKey !== undefined){
                            allQuestionsConditionsList[newKey] = curQuestionConditions; 
                        }
                                          
                    }                    
                }
                
                ///alert(allQuestionsConditionsList);               
                
                if (questions[i].linkingConditionalQuestions !== undefined) {                     
                    curOptionLinkingCondQtns = questions[i].linkingConditionalQuestions;
                    allLinkingConditionalQuestions[curQuestionId] = questions[i].linkingConditionalQuestions;
                   
                }
                
                if(curOptionLinkingCondQtns.length>0){
                    //alert(curOptionLinkingCondQtns[0]['questionId'])
                    conditionalQstIdsByGroup[curTaxonomyId] = curOptionLinkingCondQtns;
                    
                    $.each( curOptionLinkingCondQtns, function( key, value ) {                                               
                        if( value['questionId'] !== "" ){
                            if( jQuery.inArray( value['questionId'], allConditionalQtnIdsByGroup ) === -1 ){
                                allConditionalQtnIdsByGroup.push(value['questionId']);
                                ///console.log(allConditionalQtnIdsByGroup); 
                            }                            
                        }                        
                    });
                    
                }
                               
                ///console.log(questions[i]);
                if (tempTaxonomyId !== curTaxonomyId) { 
                    tempTaxonomyId = curTaxonomyId;
                    curTaxonomyName = questions[i].surveyTaxonomyName;
                    if(curTaxonomyName === "" || curTaxonomyId === null){
                        curTaxonomyName = curQuestion;
                    }
                     
                    var collapseInStatus = "";
                    if(i === 0){
                       var collapseInStatus = "in"; 
                    }
                    
                    questionnaire += 
                    "<div class='container' id='accordion'>"+        
                       "<div class='row'>" +
                            "<div class='panel-group'>" +
                                "<div class='panel panel-default'>" +
                                    "<div class='panel-heading'>" +
                                        "<h4 class='panel-title'>" +
                                            "<a data-toggle='collapse' data-parent='#accordion' href='#collapse" + i + "' class='textgreen'><b>" + curTaxonomyName + "</b></a>" +
                                        "</h4>" +
                                    "</div>"+
                                    "<div id='collapse" + i + "' class='panel-collapse collapse  "+collapseInStatus+"'>"+
                                        "<div class='panel-body'>"; 
                                        }
                                                                                
                                        ///console.log(allConditionalQtnIdsByGroup); 
                
                                        var displayQtnStatus = "";                                       
                                        ///if(curQuestionConditions.length > 0 && curOptionLinkingCondQtns.length == 0 ){
                                        if(curQuestionConditions.length > 0 && jQuery.inArray( curQuestionId, allConditionalQtnIdsByGroup ) !== -1 ){
                                            displayQtnStatus = "none";
                                        }
                                        
                                        ///console.log(curOptionLinkingCondQtns);
                                        
                                        ///<a data-toggle="modal" data-target="#myModal">
                                        
                                        var redflagClass = "";
                                        if(curSeverity === "redflag"){
                                            redflagClass = "redtext";
                                        }
                                        // console.log(curQuestion+"   ");                                       
                                        questionnaire += "<div style='display:"+ displayQtnStatus +"' id='div"+ curQuestionId +"' >"+
                                            "<li class='list-group-item atumgroup col-lg-10 col-md-10 col-sm-10 col-xs-9'>"+
                                               "<span class='glyphicon glyphicon-bookmark'></span>&nbsp;"+
                                               "<b class='"+ redflagClass +"' >" + curQuestion + "</b>"+
                                            "</li>";
                                            
                                            var curOptionId = "";
                                            var curOptionType = "";
                                            var curOptionLabel = "";
                                            var curOptionSuffixLabel = "";
                                            var curOptionValue = "";
                                            var curChiefComplaintGroupId = "";
                                            var autopopulateOptionId="";
                                            var curValidationTypeOption="";
                                            var curOptionName="";
                                            
                                            ///console.log(curChiefComplaintLinking);
                                          // console.log(typeof(curOptions)); 
                                          
                                            if(curOptions.length>0){
                                                
                                                if( curChiefComplaintLinking === 0 || curChiefComplaintLinking === "" || curChiefComplaintLinking === null ){

                                                    for(var j=0; j<curOptions.length; j++){
                                                       
                                                        curOptionId = curOptions[j].id;
                                                        curOptionType = curOptions[j].optionType;
                                                        curOptionLabel = curOptions[j].label;                                                        
                                                        curOptionSuffixLabel = curOptions[j].suffixLabel;
                                                        curOptionValue = curOptions[j].value;
                                                        curChiefComplaintGroupId = curOptions[j].chiefComplaintGroupId;
                                                        autopopulateOptionId=curOptions[j].autopopulateOptionId;
                                                        curValidationTypeOption=curOptions[j].validationType;
                                                        
                                                        autoPopulateOptArray[autopopulateOptionId]=curOptionId;
                                                        validationTypeArray[curOptionId]=curValidationTypeOption;
                                                        
                                                        
                                                        

                                                        if(curOptionLabel === "" || curOptionLabel === null){                                                
                                                            //curOptionLabel = curOptionValue.toUpperCase();
                                                            if(curOptionValue === "" || curOptionValue === null){ 
                                                                curOptionLabel = "";
                                                            }else{
                                                                curOptionLabel = curOptionValue;
                                                            }
                                                        }
                                                        if(curOptionSuffixLabel === "" || curOptionSuffixLabel === null){ 
                                                            curOptionSuffixLabel = "";
                                                        }

                                                        questionnaire += getOptionsContent(i, curTaxonomyId, curQuestionId, curOptionId, curOptionType, curOptionValue, curOptionLabel, curSeverity, curOptionSuffixLabel,curOptionName);
                                                        if(curOptionName==="radio"+ curTaxonomyId + curQuestionId){
                                                            if(allLinkingConditionalQuestions.length>0){
                                                                //console.log(allLinkingConditionalQuestions[curOptions]);
                                                           questionnaire +=
                                                            "<p class='txtrgt disp-error-patient' id='"+curOptionId+"err'></p>";
                                                        }     }                       
                                                        curOptionName="radio"+ curTaxonomyId + curQuestionId;    
                                                        
                                                    }

                                                }
                                                else{
                                                    
                                                    questionnaire += getChiefConplaintOptionsContent(i, curOptions, curTaxonomyId, curQuestionId, curOptionId, curOptionType, curOptionValue, curOptionLabel, curSeverity, curOptionSuffixLabel);
                                                                                              
                                                }
                                            }
                                            
                                            
                                            questionnaire += "</div>";
                    
                            if (nextSurveyTaxonomyId !== curTaxonomyId) { 
                                questionnaire +=
                                        "</div>"+
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>";

                    }
                    
                }
            
            //console.log(conditionalQstIdsByGroup);
            $("#pagedata").append(questionnaire);
            console.log(allQuestions);
            var valid=true;
            $(".qtnOptns").bind( "click keyup", function(){
               
                var data_group_id = $(this).attr('data-group-id');
                var data_qtn_id = $(this).attr('data-qtn-id');
                var data_opt_id = $(this).attr('data-opt-id');
                var id = $(this).attr('id');
                var data_key = $(this).attr('data-key');
                var data_order = $(this).attr('data-order');
                var val=$(this).val();
               // var data_key=$(this).attr('data-group-id');
                var data_opt=$(this).attr('data-opt-id');
                var data_qtn=$(this).attr('data-qtn-id');
                //alert(data_opt);
                checkValidation(data_opt_id,val,validationTypeArray,data_order,valid,data_key);
               if(autoPopulateOptArray.length>0){
                  // if( jQuery.inArray(data_opt_id, autoPopulateOptArray ) !== -1 ){
                   if(autoPopulateOptArray[data_opt_id]  !== undefined ){
                      var optval= $(this).val().trim();
                    if(!optval.match(reg_numbers)){
                    }
                      else if(optval!==""){
                       $("#field"+autoPopulateOptArray[data_opt_id]).val(optval);
                      }
                    
                      if(optval===""){
                          $("#field"+autoPopulateOptArray[data_opt_id]).val('');
                      }
                    }
                   
               }
               
                var curLinkCondQtnId = "";
                var linkCondQtnIdsArray = [];
                
                if(allLinkingConditionalQuestions.length > 0){
                    if(allLinkingConditionalQuestions[data_qtn_id].length > 0){                        
                                                
                        var condSurveyQtnId = "";
                        var condSurveyQtnOptnId = "";
                        var validationType = "";
                        var conditionMatchFirstvalue = "";
                        var conditionMatchSecondvalue = "";
                        
                        var displayQnts = "false";
                        
                        for (var j = 0; j < allLinkingConditionalQuestions[data_qtn_id].length ; j++) {
                            var curLinkCondQtnId = allLinkingConditionalQuestions[data_qtn_id][j]['questionId'];
                            //alert(curLinkCondQtnId)          
                                                                
                            if(allQuestionsConditionsList.length > 0){
                                linkCondQtnIdsArray[j] = curLinkCondQtnId; 
                                                                
                                $.each( allQuestionsConditionsList[curLinkCondQtnId], function( key, value ) {
                                    
                                    condSurveyQtnId =  value['conditionSurveyQuestionId'];
                                    condSurveyQtnOptnId =  value['conditionSurveyQuestionOptionId'];
                                    validationType =  value['validationType'];
                                    conditionMatchFirstvalue =  value['conditionMatchFirstvalue'];
                                    conditionMatchSecondvalue =  value['conditionMatchSecondvalue'];
                                    
                                    var curInputFieldType = $("#field"+ condSurveyQtnOptnId).attr("type");
                                    var curOptionVal = $("#field"+ condSurveyQtnOptnId).val();
                                                  
                                    ///console.log(curInputFieldType +"--"+curOptionVal);
                                    

                                    if( curInputFieldType === "radio" ){ 
                                        
                                        var qtnOptnFieldsName = "radio"+ data_group_id + condSurveyQtnId; 
                                        
                                        if( validationType === "equal" ){ 
                                            
                                            $('input:radio[name="'+qtnOptnFieldsName+'"]').each(function () {
                                                
                                                if ($(this).prop('checked')) {
                                                    var optVal = $(this).val();                                                    
                                                    if( optVal !== "" && optVal !== undefined && optVal === conditionMatchFirstvalue ){
                                                        
                                                        displayQnts = "true";
                                                        
                                                    } 
                                                }
                                            });
                                           
                                        }                                        
                                        
                                    } 
                                    else if(curInputFieldType === "text"){ 
                                        
                                        var qtnTextFieldsClass = "qtnTextField"+ condSurveyQtnId;  
                                        var optVal = $("."+ qtnTextFieldsClass).val(); 
                                        //alert(validationType)
                                        //alert(optVal)
                                        //alert(conditionMatchFirstvalue +"--"+conditionMatchSecondvalue);
                                        
                                        if(validationType === "equal"){                                            
                                                                                       
                                            if( optVal !== "" && optVal !== undefined && optVal === conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            } 
                                        }
                                        else if(validationType === "lessthan"){                                           
                                                                                 
                                            if( optVal !== "" && optVal !== undefined && optVal < conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            }                                            
                                        }
                                        else if(validationType === "greaterthan"){
                                                                                                                                 
                                            if( optVal !== "" && optVal !== undefined && optVal > conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            } 
                                        }
                                        else if(validationType === "between"){
                                            
                                            if( optVal !== "" && optVal !== undefined && (optVal > conditionMatchFirstvalue && optVal < conditionMatchSecondvalue)){
                                                displayQnts = "true";
                                            }                                          
                                        }  
                                        
                                    }
                                    else if(curInputFieldType === "ratio"){ 
                                        
                                        //console.log(curInputFieldType)                                        
                                        //console.log(validationType)
                                        
                                        var qtnTextFieldsClass = "qtnTextField"+ condSurveyQtnId;  
                                        var optVal = $("."+ qtnTextFieldsClass).val();  
                                        
                                        if(validationType === "equal"){
                                                                                                                                  
                                            if( optVal !== "" && optVal !== undefined && optVal === conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            } 
                                        }
                                        else if(validationType === "lessthan"){
                                                                                      
                                            if( optVal !== "" && optVal !== undefined && optVal < conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            }                                            
                                        }
                                        else if(validationType === "greaterthan"){
                                                                                 
                                            if( optVal !== "" && optVal !== undefined && optVal > conditionMatchFirstvalue ){
                                                displayQnts = "true";
                                            } 
                                        }
                                        else if(validationType === "between"){
                                            
                                            if( optVal !== "" && optVal !== undefined && (optVal > conditionMatchFirstvalue && optVal < conditionMatchSecondvalue)){
                                                //console.log(selectedOptnVal)
                                                displayQnts = "true";
                                                //alert(displayQnts)
                                            }                                           
                                        }
                                        
                                    }
                                    
                                });
                                
                                
                            }
                        }
                        
                       
                        if(linkCondQtnIdsArray.length > 0){
                            
                            //alert(displayQnts)
                            $.each( linkCondQtnIdsArray, function( key, value ) {
                                var qtnId = value;
                                //alert(qtnId)
                                if(qtnId !== ""){
                                    if(displayQnts === "true"){
                                        $("#div"+qtnId).css("display","block"); 
                                    }
                                    else{
                                        /*
                                        jQuery("#div"+qtnId).find(':input').each(function() {
                                            switch(this.type) {                                                
                                                case 'text':                                                
                                                case 'checkbox':
                                                case 'radio':
                                                    this.checked = false;
                                            }
                                        });
                                        */
                                       
                                        $("#div"+qtnId).css("display","none");
                                    }
                                }                                    
                            });
                            
                        }
                        
                    }
                }
                                              
                
            });
            
            $("#next").click(function(event) {
                
                     var valid=true;
                $(".qtnOptns").each(function(){
                    
                    var data_type=$(this).attr('type');
                    var data_name=$(this).attr('name');
                    var opt_id = $(this).attr('data-opt-id');
                    var data_order = $(this).attr('data-order');
                    var opt_val=$(this).val();
                    var qstid=$(this).attr('data-qtn-id');
                    var data_key=$(this).attr('data-key');
                    valid=checkValidation(opt_id,opt_val,validationTypeArray,data_order,valid,data_key);
                    valid=checkOptionType(data_type,data_name,opt_id,opt_val,data_order,qstid,allConditionalQtnIdsByGroup,valid,data_key);
                    
                }); 
                 
                console.log(valid);
                    if(valid===true){
                        var preqtsid;
                        var allSelectedQtnIds=[];
                        var allSelectedOptionIds=[];
                        var allSelectedOptionValues=[];
                        var selValues = [];//allQuestions
                        var qstid=$(this).attr('data-qtn-id');
                       console.log(qstid+' :)');
                    $(".qtnOptns").each(function(){
                        var qstid=$(this).attr('data-qtn-id');
                        var data_type=$(this).attr('type');
                        var data_name=$(this).attr('name');
                                               
                      if(data_type==='radio'){
                        if(preqtsid!==qstid){
                        var radioval=$("input:radio[name='"+data_name+"']:checked").val();                        
                        var data_qtn=$($("input:radio[name='"+data_name+"']:checked")).attr('data-qtn-id');
                        var data_opt=$($("input:radio[name='"+data_name+"']:checked")).attr('data-opt-id');
                        console.log(radioval);
                        console.log(data_opt);
                        if(data_qtn!==undefined)
                        {   
                        allSelectedQtnIds.push(data_qtn);                      
                        }
                        if( data_opt!==undefined){
                          allSelectedOptionIds.push(data_opt); 
                        }
                         if(radioval!==undefined)
                        allSelectedOptionValues.push(radioval);
                        }
                        preqtsid=qstid;
                     }
                        if(data_type==='text'){
                           var opt_val=$(this).val();
                           console.log(opt_val);
                           var data_qtn=$(this).attr('data-qtn-id');
                         if($.inArray(opt_val,allSelectedQtnIds)===-1)
                         {   
                           allSelectedQtnIds.push(data_qtn);                      
                         }
                         if($.inArray(data_opt,allSelectedOptionIds)===-1 && data_opt!==undefined)
                         {
                          allSelectedOptionIds.push(data_opt); 
                         }
                          allSelectedOptionValues.push(opt_val);
                        }
                        
                    });
                     var sel = document.getElementById('dates-field2');
    
                for(var i=0; i < sel.length; i++){
                    if(sel.options[i].selected){
                      selValues.push(sel.options[i].value);
                     }
                }
                    console.log(selValues);
                    console.log(allSelectedQtnIds);
                    console.log(allSelectedOptionIds);
                    console.log(allSelectedOptionValues);
                    switchView();
                   
                }
                
            });
            
    
        },
        error: function (xhr, status, error) {
            console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);

        }
    });

   
    $.ajax({
        url: site_url + 'api/mobile/v1/Networkhospital',
        type: 'GET',
        success: function (data) {
            //console.log(data);
            
            var networkhospitalData = data.response.networkhospitalData;
            ///console.log(networkhospitalData);
            if(networkhospitalData.length > 0){ 
                var hospitalsList ="";
                $.each( networkhospitalData, function( key, value ) {
                    var name = value['name'];
                    if(name !=="" && name !== undefined){
                        
                        hospitalsList += '<div class="padbot"><label class="radio-inline"><input type="checkbox" name="hospital" value="'+name+'"> <b>'+name+'</b></label></div>';
                        
                    }                    
                }); 
                
                $("#hospitalsList").append(hospitalsList);
            }    
            
            
            
        },
        error: function (xhr, status, error) {
            console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);

        }
    });

});





function getOptionsContent(i, curTaxonomyId, curQuestionId, curOptionId, curOptionType, curOptionValue, curOptionLabel, curSeverity, curOptionSuffixLabel,curOptionName){
    
    ////console.log(i+", "+curTaxonomyId+", "+curQuestionId+", "+curOptionId+", "+curOptionType+", "+curOptionValue+", "+curOptionLabel+", "+curSeverity+", "+curOptionSuffixLabel);
    
    var questionnaire = "";
    
    if(curOptionType === "radio"){             
                                                            
        var modalAttrs = "";
       
        if( curSeverity === "redflag" && (curOptionValue === "yes" || curOptionValue === "Yes") ){
            modalAttrs = "  data-toggle='modal' data-target='#myModal' ";
        }
        
        questionnaire +=
        "<li class='list-group-item  clox2 atumgroup col-md-1 col-sm-1 col-xs-2 '>" +
            "<label>" +                                                                    
                "<input "+modalAttrs+" type='radio' name='radio"+ curTaxonomyId + curQuestionId +"' class='optGroup"+curTaxonomyId+" qtnOptns qtnRadioOptns"+ curTaxonomyId +" qtnOptnField"+ curQuestionId +" ' data-group-id='"+ curTaxonomyId +"' data-qtn-id='"+ curQuestionId +"' data-opt-id='"+ curOptionId +"' id='field"+ curOptionId +"' data-order='' data-key="+i+" value='"+ curOptionValue +"'> "+ curOptionLabel +
            "</label>"+
        "</li>";
//console.log(curOptionName);
//console.log(curOptionName+"!==radio"+ curTaxonomyId + curQuestionId);
         
        
        // "<span class='disp-error-patient' id='"+curOptionId+"err'></span>"; 
    }
    else if(curOptionType === "text"){          
        questionnaire +=                                                
        "<li class='list-group-item atumgroup col-md-2 col-sm-2 col-xs-3'>" +
            "<label>" + curOptionLabel+ 
                "<input type='text' name='text"+ curTaxonomyId + curQuestionId +"' class='form-control logininput optGroup"+curTaxonomyId+" qtnOptns qtnTextOptn"+ curTaxonomyId +"  qtnTextField"+ curQuestionId +" ' data-group-id='"+ curTaxonomyId +"' data-qtn-id='"+ curQuestionId +"' data-opt-id='"+ curOptionId +"' id='field"+ curOptionId +"'data-order='' data-key="+i+" placeholder=''>"+ curOptionSuffixLabel +
            "<span class='disp-error-patient' id='"+curOptionId+"err'></span></label>"+
        "</li>"; 
    }
    else if(curOptionType === "ratio"){          
        questionnaire +=                                                
        "<li class='list-group-item atumgroup col-md-1 col-sm-1 col-xs-2'>" +
            "<label>" +  
                "<input type='text' name='text"+ curTaxonomyId + curQuestionId +"' class='form-control logininput optGroup"+curTaxonomyId+" qtnOptns qtnTextOptn"+ curTaxonomyId +"  qtnTextField"+ curQuestionId +" ' data-group-id='"+ curTaxonomyId +"' data-qtn-id='"+ curQuestionId +"' data-opt-id='"+ curOptionId +"' id='field"+ curOptionId +"' data-order='1' data-key="+i+" placeholder=''>"+ 
            "</label>"+
        "</li>"+ 
        "<li class='list-group-item atumgroup col-md-1 col-sm-1 col-xs-2'>" +
            "<label>" +  
                "<input type='text' name='text"+ curTaxonomyId + curQuestionId +"' class='form-control logininput optGroup"+curTaxonomyId+" qtnOptns qtnTextOptn"+ curTaxonomyId +"  qtnTextField"+ curQuestionId +" ' data-group-id='"+ curTaxonomyId +"' data-qtn-id='"+ curQuestionId +"' data-opt-id='"+ curOptionId +"' id='field"+ curOptionId +"2'  data-order='2' data-key="+i+" placeholder=''>"+
            "</label>"+
        "</li>"+
        "<span class='col-lg-offset-10'></span>"+
         "<span class='disp-error-patient pad15' id='"+curOptionId+"err'></span>" ; 
    }

    return questionnaire;
}

function getChiefConplaintOptionsContent(i, curOptions){
    
    ////console.log(i+", "+curOptions);
    
    var questionnaire = "";
    
    questionnaire +=       
    "<li class='list-group-item atumgroup col-md-2 col-md-2 col-sm-2 col-xs-2'>"+
        "<select id='dates-field2' class='multiselect-ui form-control logininput' multiple='multiple'>"+
            "<option >Select</option>";

            for(var j=0; j<curOptions.length; j++){
                curOptionId = curOptions[j].id;
                //curOptionType = curOptions[j].optionType;
                curOptionLabel = curOptions[j].label;
                //curOptionSuffixLabel = curOptions[j].suffixLabel;
                curOptionValue = curOptions[j].value;
                curChiefComplaintGroupId = curOptions[j].chiefComplaintGroupId;

                questionnaire +="<option value='"+curOptionId+"'>"+curOptionLabel+"</option>";
                
            }
           
            questionnaire +="<option>Others</option>"+
        "</select>"+
    "</li>";
    $( document ).ready(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
    

    return questionnaire;
}

function checkValidation(opt_id,opt_val,validationTypeArray,data_order,valid,data_key){
    
    var optvalidtype=validationTypeArray[opt_id];
    var reg_numbers=/^[0-9]*$/;
    //var reg_decimal=/^[1-9]\d+\.\d{1,2}$/;
    var reg_decimal=/^\d+(\.\d{1,2})?$/;
    var ratio=data_order;
     if(optvalidtype==='string'){}
     
     else if(optvalidtype==='number'){
         if(!opt_val.match(reg_numbers) || opt_val.length===0){
                 if(ratio==='1'){
                    $("#field"+opt_id+"").addClass('validred');
                 }
                 if(ratio==='2'){
                    $("#field"+opt_id+"2").addClass('validred');
                 }
                 $("#"+opt_id+"err").text("Please enter numbers only!");
                valid=false;
                $('collapse'+data_key).each(function(){
                    console.log('here');
                if ($(this).hasClass('in')) {
                  $(this).collapse('toggle');
                   }
                   });
         }
         else{
             $("#field"+opt_id+"").removeClass('validred');
             $("#field"+opt_id+"2").removeClass('validred');
             $("#"+opt_id+"err").text("");
             //valid=true;
         }
       
      }
     else if(optvalidtype==='decimal'){
//         if(opt_val===""){
//             $("#"+opt_id+"err").text("");
//             $("#field"+opt_id+"").removeClass('validred'); 
//         }
         if(!opt_val.match(reg_decimal)){
         $("#field"+opt_id+"").addClass('validred');   
         $("#"+opt_id+"err").text("Please enter decimals only!");
         $('#collapse'+(data_key)).addClass('in');
         valid=false;
         
         }
         else{
             $("#"+opt_id+"err").text("");
             $("#field"+opt_id+"").removeClass('validred');
             //valid=true;
         }
      }
      return valid;
}



function checkOptionType(data_type,data_name,opt_id,opt_val,data_order,qstid,allConditionalQtnIdsByGroup,valid,data_key){
    var reg_numbers=/^\d$/;
    if(data_type==='radio'){
        if(!$("input:radio[name='"+data_name+"']").is(":checked")){
            var id=$("input:radio[name='"+data_name+"']").data('qtn-id');
            if($.inArray(id,allConditionalQtnIdsByGroup)!==-1){   
              $("#"+opt_id+"err").text(""); 
            }
            else{
                 // console.log('hey');
            $("#"+opt_id+"err").text("Please select one of the options!");
            $('#collapse'+(data_key)).addClass('in');
            valid=false;
            $("input:radio[name='"+data_name+"']").change(function(){                
               $("#"+opt_id+"err").text(""); 
               //valid=true;
               
            });
            }
        }
    }
    
    if(data_type==='text'){       
        
        if(opt_val==='' || opt_val.length===0){
           
            $("#field"+opt_id+"").addClass('validred');                
            $("#field"+opt_id+"2").addClass('validred');                 
            $("#"+opt_id+"err").text("Please enter this field!");
            $("#field"+opt_id+"").focus();
            $('#collapse'+(data_key)).addClass('in');
            valid=false;  
           // console.log('collapse'+(data_key));
           
        }
        
        else{
             $("#field"+opt_id+"").removeClass('validred');
             $("#field"+opt_id+"2").removeClass('validred');
             $("#"+opt_id+"err").text("");
             //valid=true;
         }      
    }
    
    if(data_type==='decimal'){
        if(opt_val===''){
         $("#field"+opt_id+"").addClass('validred');   
         $("#"+opt_id+"err").text("Please enter this field!");
         valid=false;
         }
         else{
             $("#"+opt_id+"err").text("");
             $("#field"+opt_id+"").removeClass('validred');
             //valid=true;
         }
    }
    return valid;
}


