(function($){
    $(document).ready(function(){
        
//        $(window).on('click', function(e){
//            if(!$(e.target).hasClass('.ays_modal_question')){
//                if($(e.target).parents('.ays_modal_question.active_question').length == 0){
//                    deactivate_questions();
//                }
//            }
//        });
        
        $(document).find('#ays_quick_start').on('click', function () {
            $('#ays-quick-modal').aysModal('show');
            var activate_first_question = $(document).find('#ays_question_id_1');
            if (! activate_first_question.hasClass('active_question')) {
                activate_first_question.addClass('active_question');
                activate_question(activate_first_question);
            }
        });
        
        $(document).on('click', '.ays_modal_question', function (e) {
            if (!$(this).hasClass('active_question')) {
                deactivate_questions();
                activate_question($(this));
            }
        });        
        
        $(document).find('#ays-quick-modal-content .ays-close').on('click', function () {
//            $(document).find('#ays-quick-modal-content').css('animation-name', 'zoomOut');
//            setTimeout(function(){
//                $(document).find('#ays-quick-modal').modal('hide');
//            }, 250);
//            deactivate_questions();
        });

        $(document).on('click', '.active_remove_answer', function () {
            if($(this).parents('.ays_answers_table').find('.ays_answer_td').length == 2){
                swal.fire({
                    type: 'warning',
                    text:'Sorry minimum count of answers should be 2'
                });
                return false;
            }
            var item = $(this).parents().eq(0);
            $(this).parents().eq(0).addClass('animated fadeOutLeft');
            setTimeout(function () {
                item.remove();
            }, 400);
        });

        $(document).on('click', '.ays_trash_icon', function () {
            if ($(document).find('.ays_modal_question').length == 1) {
                swal.fire({
                    type: 'warning',
                    text:'Sorry minimum count of questions should be 1'
                });
                return false;
            }
//            var item = $(this).parent('.ays-modal-flexbox.flex-end').parent('.ays_modal_element.ays_modal_question');
            var item = $(this).parents('.ays_modal_element.ays_modal_question');
            item.addClass('animated fadeOutLeft');
            setTimeout(function () {
                item.remove();
            }, 400);

        });

        $(document).on('click', '.ays_modal_element.ays_modal_question', function() {
            if (! $(this).hasClass('active_question_border')) {
                $(document).find('#ays-quick-modal-content .ays_modal_element.ays_modal_question').removeClass('active_question_border');
                $(this).addClass('active_question_border');
            }
        });

        // Dublicate Question
        $(document).on('click','.ays_question_clone_icon', function (e) {
            var question_max_inp_id = $(document).find('#ays_quick_question_max_id');
            var question_max_id = parseInt(question_max_inp_id.val());
            if (isNaN(question_max_id)) {
                question_max_id = 1;
            }
            var ays_answer_radio_id = ( question_max_id + 1 );
            question_max_inp_id.val(ays_answer_radio_id);

            var cloningElement = $(this).parents('.ays_modal_element.ays_modal_question');
            var questionType = cloningElement.find('.ays_quick_question_type').val();
            var questionCat = cloningElement.find('.ays_quick_question_cat').val();
            var parentId = cloningElement.attr('id');

            $(document).find('#'+parentId+' .ays_answer_unique_id:checked').addClass('checkedElement');

            var cloneElem  = cloningElement.clone();
            cloneElem.prop('id','ays_question_id_'+ays_answer_radio_id);
            cloneElem.insertAfter('#'+parentId);

            var clonedElement = $(document).find('#ays_question_id_'+ays_answer_radio_id);
            clonedElement.find('.ays_question_input').select();
            clonedElement.find('.ays_quick_question_type option[value='+ questionType +']').attr('selected','selected');
            clonedElement.find('.ays_quick_question_cat option[value='+ questionCat +']').attr('selected','selected');
            clonedElement.find('.ays_answer_unique_id').attr('name','ays_answer_radio['+ays_answer_radio_id+']');

            var checkedRadio = $(document).find('#'+parentId+' .checkedElement');
            checkedRadio.attr('checked','checked');
            setTimeout(function () {
                $(document).find('#ays-quick-modal-content .ays_modal_element.ays_modal_question').removeClass('active_question_border');
                clonedElement.addClass('active_question_border');
            },100);

        });

        // Change Question Type
        $(document).on('change', '.ays_quick_question_type', function (e) {
            var questionType = $(this).val();
            var parent = $(this).parents('.ays_modal_question');

            switch (questionType) {
                case 'radio':
                    parent.find('.ays_answers_table .ays_answer_unique_id').attr('type','radio');
                    break;
                case 'checkbox':
                    parent.find('.ays_answers_table .ays_answer_unique_id').attr('type','checkbox');
                    break;
                case 'select':
                    parent.find('.ays_answers_table .ays_answer_unique_id').attr('type','radio');
                    break;
                default:
                    parent.find('.ays_answers_table .ays_answer_unique_id').attr('type','radio');
                    break;
            }
        });

        $(document).on('click', '.ays_add_question', function () {
            var question_max_inp_id = $(document).find('#ays_quick_question_max_id');
            var question_max_id = parseInt(question_max_inp_id.val());
            if (isNaN(question_max_id)) {
                question_max_id = 1;
            }
            var ays_answer_radio_id = ( question_max_id + 1 );
            question_max_inp_id.val(ays_answer_radio_id);

            var ays_quiz_catObj = aysQuizCatObj.category;
            var appendAble =
                '<div class="ays_modal_element ays_modal_question active_question active_question_border" id="ays_question_id_'+ays_answer_radio_id+'">'+
                '    <div class="form-group row">' +
                '        <div class="col-sm-9">' +
                '            <input type="text" value="'+quizLangObj.questionTitle+'" class="ays_question_input">' +
                '        </div>' +
                '        <div class="col-sm-3" style="text-align: right;">' +
                '            <select class="ays_quick_question_type" id="ays_quick_question_type_'+ays_answer_radio_id+'" name="ays_quick_question_type[]" style="width: 120px;">' +
                '                <option value="radio">'+quizLangObj.radio+'</option>' +
                '                <option value="checkbox">'+quizLangObj.checkbox+'</option>' +
                '                <option value="select">'+quizLangObj.dropdawn+'</option>' +
                '            </select>' +
                '        </div>' +
                '    </div>' +
                '    <div class="form-group row">' +
                '        <div class="col-sm-9">' +
                '        </div>' +
                '        <div class="col-sm-3" style="text-align: right;">' +
                '            <select class="ays_quick_question_cat" id="ays_quick_question_cat_'+ays_answer_radio_id+'" name="ays_quick_question_cat[]" style="width: 120px;">';
                            for(var k in ays_quiz_catObj ){
                                appendAble += '<option value="'+ays_quiz_catObj[k]['id']+'">'+ays_quiz_catObj[k]['title']+'</option>';
                            }
                appendAble += '</select>' +
                '        </div>' +
                '    </div>' +

                '    <div class="ays-modal-flexbox flex-end">' +
                '        <table class="ays_answers_table">' +
                '            <tr>' +
                '                <td>' +
                '                    <input class="ays_answer_unique_id" type="radio" name="ays_answer_radio['+ays_answer_radio_id+']" checked>' +
                '                </td>' +
                '                <td class="ays_answer_td">' +
                '                    <p class="ays_answer"></p>' +
                '                    <p>Answer</p>' + +
                '                </td>' +
                '                <td class="show_remove_answer">' +
                '                    <i class="ays_fa ays_fa_times" aria-hidden="true"></i>' +
                '                </td>' +
                '            </tr>' +
                '            <tr>' +
                '                <td>' +
                '                    <input class="ays_answer_unique_id" type="radio" name="ays_answer_radio['+ays_answer_radio_id+']">' +
                '                </td>' +
                '                <td class="ays_answer_td">' +
                '                    <p class="ays_answer"></p>' +
                '                    <p>Answer</p>' +
                '                </td>' +
                '                <td class="show_remove_answer">' +
                '                    <i class="ays_fa ays_fa_times" aria-hidden="true"></i>' +
                '                </td>' +
                '            </tr>' +
                '            <tr>' +
                '                <td>' +
                '                    <input class="ays_answer_unique_id" type="radio" name="ays_answer_radio['+ays_answer_radio_id+']">' +
                '                </td>' +
                '                <td class="ays_answer_td">' +
                '                    <p class="ays_answer"></p>' +
                '                    <p>Answer</p>' +
                '                </td>' +
                '                <td class="show_remove_answer">' +
                '                    <i class="ays_fa ays_fa_times" aria-hidden="true"></i>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="show_add_answer">' +
                '                <td colspan="3">' +
                '                    <a href="javascript:void(0)" class="ays_add_answer">' +
                '                        <i class="ays_fa ays_fa_plus_square" aria-hidden="true"></i>' +
                '                    </a>' +
                '                </td>' +
                '            </tr>' +
                '        </table>' +
                '        <div>' +
                '            <a href="javascript:void(0)" class="ays_question_clone_icon">' +
                '                <i class="ays_fa ays_fa_clone" aria-hidden="true"></i>' +
                '            </a>' +
                '            <a href="javascript:void(0)" class="ays_trash_icon">' +
                '                <i class="ays_fa ays_fa_trash_o" aria-hidden="true"></i>' +
                '            </a>' +
                '        </div>' +
                '    </div>' +
                '</div>';
            $(document).find('.ays-quick-questions-container').append(appendAble);
            var question_conteiner = $(document).find('#ays_question_id_'+ ays_answer_radio_id);
            activate_question(question_conteiner);
        });


        $(document).on('click', '.ays_add_answer', function () {
            var question_id = $(document).find('.ays_modal_question').index($(this).parents('.ays_modal_question'));
            var parent = $(this).parents('.ays_modal_question');
            var questionType = parent.find('.ays_quick_question_type').val();
            var questType;
            switch (questionType) {
                case 'radio':
                    questType = 'radio';
                    break;
                case 'checkbox':
                    questType = 'checkbox';
                    break;
                case 'select':
                    questType = 'radio';
                    break;
                default:
                    questType = 'radio';
                    break;
            }

            $(this).parents().eq(1).before('<tr><td><input class="ays_answer_unique_id" type="'+ questType +'" name="ays_answer_radio[' + (++question_id) + ']"></td><td class="ays_answer_td"><input type="text" placeholder="'+ quizLangObj.emptyAnswer +'" class="ays_answer"></td><td class="active_remove_answer"><i class="ays_fa ays_fa_times" aria-hidden="true"></i></td></tr>');

            var tableTr = $(this).parents('.ays_answers_table').find('tr');
            var childLength = tableTr.length;
            var postPreviousChild = childLength - 2;
            tableTr.eq(postPreviousChild).find('.ays_answer').select();

//            $(this).parents().eq(1).before('<tr><td><input type="radio" name="ays_answer_radio[' + (++question_id) + ']"></td><td class="ays_answer_td"><input type="text" placeholder="Empty Answer" class="ays_answer"></td><td class="active_remove_answer"><i class="ays_fa ays_fa_times" aria-hidden="true"></i></td></tr>');
        });
        
        
        
    });
})(jQuery);
