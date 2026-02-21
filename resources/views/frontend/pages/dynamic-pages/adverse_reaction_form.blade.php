<div class="row">
    <div class="col-md-8 form_block std">
        <div id="event_report_form_form" style="display: none;">
            <form action="{{ route('adverse-reaction.store') }}" class="form_farmakonnadzor" id="adverse_reaction_form" method="POST" enctype="multipart/form-data">
                @csrf
                <h4>Информация о лице, сообщающем о НР</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Лицо сообщающее о НР</label>
                        <select class="custom-select" name="person_reporting" id="person_reporting">
                            <option value="Врач">Врач</option>
                            <option value="Другой специалист системы здравоохранения">Другой специалист системы
                                здравоохранения</option>
                            <option value="Пациент">Пациент</option>
                            <option value="Иной">Иной</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>ФИО *</label>
                        <input type="text" class="form-control" name="full_name" value="" id="full_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Должность и место работы</label>
                        <textarea class="form-control" name="position_work_place" id="position_work_place"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>E-Mail *</label>
                        <input type="text" class="form-control" name="email" id="email" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Дата сообщения</label>
                        <input type="text" class="form-control" name="date_of_message" id="date_of_message" value="">
                    </div>
                </div>

                <h4>Информация о пациенте</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Инициалы пациента (код) *</label>
                        <input type="text" class="form-control" name="patient_initials_code" id="patient_initials_code" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Вес</label>
                        <input type="text" class="form-control" name="weight" id="weight" value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Возраст</label>
                        <input type="text" class="form-control" name="age" id="age" value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Пол</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="Мужской"
                                checked>
                            <label class="form-check-label" for="gender">Мужской</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="Женский">
                            <label class="form-check-label" for="gender">Женский</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Беременность</label>
                        <div class="form-check">
                            <input class="form-check-input updater" type="radio" name="pregnancy" id="pregnancy"
                                value="Нет" checked>
                            <label class="form-check-label" for="pregnancy">Нет</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input updater" type="radio" name="pregnancy" id="pregnancy"
                                value="Да">
                            <label class="form-check-label" for="pregnancy">Да</label>
                        </div>
                    </div>
                </div>

                <h4>Аллергия</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Есть аллергия</label>
                        <div class="form-check">
                            <input class="form-check-input updater" type="radio" name="allergy" id="allergy" value="Нет"
                                checked>
                            <label class="form-check-label" for="allergy">Нет</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input updater" type="radio" name="allergy" id="allergy" value="Да">
                            <label class="form-check-label" for="allergy">Да</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                </div>

                <h4>Информация о препарате, предположительно вызвавшем НР</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Наименование ЛС (торговое) *</label>
                        <input type="text" class="form-control" name="drug_name" id="drug_name" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Номер серии</label>
                        <input type="text" class="form-control" name="serial" id="serial" value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Производитель</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Доза, путь введения</label>
                        <input type="text" class="form-control" name="dose" id="dose" value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Дата начала приема</label>
                        <input type="text" class="form-control" name="admission_start_date" id="admission_start_date" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Дата прекращения приема</label>
                        <input type="text" class="form-control" name="discontinuation_end_date" id="discontinuation_end_date" value="">
                    </div>
                </div>

                <h4>Информация о нежелательной реакции</h4>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Описание реакции (укажите все детали, включая данные лабораторных исследований) *</label>
                        <textarea class="form-control" name="description_of_reaction" id="description_of_reaction"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Дата начала НР</label>
                        <input type="text" class="form-control" name="start_date_of_nr" id="start_date_of_nr" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Дата прекращения НР</label>
                        <input type="text" class="form-control" name="nr_termination_date" id="nr_termination_date" value="">
                    </div>
                </div>

                <h4>Критерии серьезности НР</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Смерть" checked>
                            <label class="form-check-label" for="criteria_for_the_severity">Смерть</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Угроза жизни">
                            <label class="form-check-label" for="criteria_for_the_severity">Угроза жизни</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Госпитализация или ее продление">
                            <label class="form-check-label" for="criteria_for_the_severity">Госпитализация или ее продление</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Инвалидность">
                            <label class="form-check-label" for="criteria_for_the_severity">Инвалидность</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Врожденные аномалии" checked>
                            <label class="form-check-label" for="criteria_for_the_severity">Врожденные аномалии</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Клинически значимое событие" checked>
                            <label class="form-check-label" for="criteria_for_the_severity">Клинически значимое событие</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="criteria_for_the_severity" id="criteria_for_the_severity" value="Не применимо" checked>
                            <label class="form-check-label" for="criteria_for_the_severity">Не применимо</label>
                        </div>
                    </div>
                </div>

                <h4>Предпринятые меры</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="measures_taken" id="measures_taken" value="Без лечения" checked>
                            <label class="form-check-label" for="measures_taken">Без лечения</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="measures_taken" id="measures_taken" value="Отмена подозреваемого ЛС">
                            <label class="form-check-label" for="measures_taken">Отмена подозреваемого ЛС</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="measures_taken" id="measures_taken" value="Снижение дозы ЛС">
                            <label class="form-check-label" for="measures_taken">Снижение дозы ЛС</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="measures_taken" id="measures_taken" value="Немедикаментозная терапия (в т.ч. хирургическое вмешательство)">
                            <label class="form-check-label" for="measures_4">Немедикаментозная терапия (в т.ч. хирургическое
                                вмешательство)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="measures_taken" id="measures_taken" value="Лекарственная терапия">
                            <label class="form-check-label" for="measures_taken">Лекарственная терапия</label>
                        </div>
                    </div>
                </div>

                <h4>Исход</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_1"
                                value="Выздоровление без последствий" checked>
                            <label class="form-check-label" for="result_1">Выздоровление без последствий</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_2"
                                value="Улучшение состояния">
                            <label class="form-check-label" for="result_2">Улучшение состояния</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_3"
                                value="Состояние без изменений">
                            <label class="form-check-label" for="result_3">Состояние без изменений</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_4"
                                value="Выздоровление с последствиями">
                            <label class="form-check-label" for="result_4">Выздоровление с последствиями</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_5" value="Смерть">
                            <label class="form-check-label" for="result_5">Смерть</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_6" value="Неизвестно">
                            <label class="form-check-label" for="result_6">Неизвестно</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exodus" id="result_7" value="Не применимо">
                            <label class="form-check-label" for="result_7">Не применимо</label>
                        </div>
                    </div>
                </div>

                <h4>Сопровождалось ли отмена ЛС исчезновением НПР?</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_the_discontinuation" id="cancel_1" value="Да"
                                checked>
                            <label class="form-check-label" for="cancel_1">Да</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_the_discontinuation" id="cancel_2" value="Нет">
                            <label class="form-check-label" for="cancel_2">Нет</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_the_discontinuation" id="cancel_3"
                                value="ЛС не отменялось">
                            <label class="form-check-label" for="cancel_3">ЛС не отменялось</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_the_discontinuation" id="cancel_4" value="Не применимо">
                            <label class="form-check-label" for="cancel_4">Не применимо</label>
                        </div>
                    </div>
                </div>

                <h4>Отмечено ли повторение НПР после повторного назначения ЛС?</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_there_a_recurrence" id="return_1" value="Да"
                                checked>
                            <label class="form-check-label" for="return_1">Да</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_there_a_recurrence" id="return_2" value="Нет">
                            <label class="form-check-label" for="return_2">Нет</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="was_there_a_recurrence" id="return_3"
                                value="ЛС повторно не назначалось">
                            <label class="form-check-label" for="return_3">ЛС повторно не назначалось</label>
                        </div>
                    </div>
                </div>

                <h4>Другие препараты, принимаемые пациентом в течение последних 3 месяцев, включая ЛС принимаемые
                    самостоятельно (по собственному желанию)</h4>
                <div id="other_meds_container">
                    <div class="other_med_item instance">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Наименование ЛС (торговое)</label>
                                <input type="text" class="form-control" name="omt_name[]" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Номер серии</label>
                                <input type="text" class="form-control" name="omt_serial[]" value="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Производитель</label>
                                <input type="text" class="form-control" name="omt_manufacturer[]" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Доза, путь введения</label>
                                <input type="text" class="form-control" name="omt_dose[]" value="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Дата начала приема</label>
                                <input type="text" class="form-control" name="omt_date_start[]" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Дата прекращения приема</label>
                                <input type="text" class="form-control" name="omt_date_end[]" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mb-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-sm" id="add_more">+ Добавить еще препарат</button>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end mb-2 gap-2">
                    <div class="form-group mr-3">
                        <button type="button" class="btn btn-danger cancel_reaction_form">Отмена</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Отправить сообщение</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>