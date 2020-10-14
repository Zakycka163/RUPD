<div class="modal fade" id="discipline_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="discipline_form_title">Создание дисциплины</h5>
                </div>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="align-middle">Кафедра<span style="color: red">*</span></td>
                        <td width="70%">
                            <div class="input-group input-group-sm" id="parent_kaf" data-toggle="popover"
                                data-placement="right" data-content="Нужно выбрать!">
                                <input type="text" id="parent_kaf_name" class="form-control form-control-sm"
                                    value="Отсутствует" data-toggle="tooltip" data-placement="top" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-sm" id="add_parent_kaf_name"
                                        type="button">Выбрать</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Индекс<span style="color: red">*</span></td>
                        <td>
                            <input type="text" id="index" maxlength="10" class="form-control form-control-sm"
                                data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Название<span style="color: red">*</span></td>
                        <td>
                            <input type="text" id="discipline_name" maxlength="100" class="form-control form-control-sm"
                                data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Модуль<span style="color: red">*</span></td>
                        <td>
                            <select class="form-control form-control-sm" id="mod_val" data-toggle="popover"
                                data-placement="right" data-content="Нужно выбрать!">
                                <option selected value="null"></option>
                                <?php 
									require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
									options_present("SELECT id
														  , `name`
													 FROM modules  
													 ORDER BY id");
								?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Относится к<span style="color: red">*</span></td>
                        <td>
                            <select class="form-control form-control-sm" id="part_val" data-toggle="popover"
                                data-placement="right" data-content="Нужно выбрать!">
                                <option selected value="null"></option>
                                <?php 
									require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
									options_present("SELECT id
														  , CONCAT(`name`,' части')
													 FROM parts  
													 ORDER BY id");
								?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Нагрузка, ч<span style="color: red">*</span></td>
                        <td>
                            <input type="number" id="discipline_time" max="500" class="form-control form-control-sm"
                                data-toggle="popover" data-placement="right" data-content="Нужно заполнить!">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <?php if (isset($_GET["kafid"])) { ?>
                <button type="button" class="btn btn-sm btn-danger" id="delete_discipline">Удалить</button>
                <button type="button" class="btn btn-sm btn-primary" id="save_discipline">Сохранить</button>
                <?php } else { ?>
                <button type="button" class="btn btn-sm btn-primary" id="add_new_discipline">Создать</button>
                <?php }; ?>
                <button type="button" class="btn btn-sm btn-secondary close_form" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_parent_kaf_name_form" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Кафедра</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="align-middle">Институт<span style="color: red">*</span></td>
                        <td>
                            <select class="form-control form-control-sm" id="inst_val">
                                <option selected value="null">Отсутствует</option>

                                <?php 
									require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
									options_present("SELECT institute_id
														  , `name`
													 FROM institutes  
													 ORDER BY institute_id");
								?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Кафедра<span style="color: red">*</span></td>
                        <td>
                            <select class="form-control form-control-sm" id="kaf_val" disabled>
                                <option selected value="null">Отсутствует</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" id="save_parent_kaf_name_button">Сохранить</button>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
$("#pul_name").mouseenter(function() {
    $('#pul_name').removeClass('error-pointer');
    $('#pul_name').popover('hide');
});

$("#parent_inst_name").mouseenter(function() {
    $('#parent_inst').removeClass('error-pointer');
    $('#parent_inst').popover('hide');
});

$("#parent_inst_name").mouseenter(function() {
    $('#parent_inst_name').tooltip('show');
});

$("#add_parent_kaf_name").click(function() {
    $("#add_parent_kaf_name_form").modal('show');
});

$("#save_parent_inst_name_button").click(function() {
    var inst_id = $("#inst_val").val();
    var inst_text = $("#inst_val option:selected").text();
    $("#parent_inst_name").val(inst_text);
    $("#parent_inst_name").prop('title', inst_text);

    if (inst_id !== "null") {
        $("#add_parent_inst_name").removeClass('btn-outline-success');
        $("#add_parent_inst_name").addClass('btn-outline-primary');
        $("#add_parent_inst_name").text('Изменить');
    } else {
        $("#add_parent_inst_name").removeClass('btn-outline-primary');
        $("#add_parent_inst_name").addClass('btn-outline-success');
        $("#add_parent_inst_name").text('Выбрать');
    }
    $("#add_parent_inst_name_form").modal('hide');
});

$("#add_new_discipline").click(function() {
    let dis_name = $("#discipline_name").val();
    let pul_description = $("#pul_description").val();
    let inst_id = $("#inst_val").val();

    if (inst_id == "null") {
        $('#parent_inst').addClass('error-pointer');
        $('#parent_inst').popover('show');
    } else if (pul_name == '') {
        $('#pul_name').addClass('error-pointer');
        $('#pul_name').popover('show');
    } else {
        $.post(
            "/back/data/db_pulpits.php", {
                functionname: 'create_pulpit',
                instid: inst_id,
                name: pul_name,
                description: pul_description
            },
            function(info) {
                if (info !== '1') {
                    alert(info);
                } else {
                    $('#pulpit_form').modal('hide');
                    alert('Дисциплина создана');
                    location.href = 'data.php?page=disciplines';
                }
            }
        );
    }
});

$("#save_discipline").click(function() {
    let dis_name = $("#discipline_name").val();


    if (inst_id == "null") {
        $('#parent_inst').addClass('error-pointer');
        $('#parent_inst').popover('show');
    } else if (dis_name == '') {
        $('#discipline_name').addClass('error-pointer');
        $('#discipline_name').popover('show');
    } else {
        $.post(
            "/back/data/db_disciplines.php", {
                functionname: 'edit_discipline',
                id: $_GET('disid'),
                instid: inst_id,
                name: dis_name,
                description: pul_description
            },
            function(info) {
                if (info !== '1') {
                    alert(info);
                } else {
                    $('#discipline_form').modal('hide');
                    alert('Дисциплина обновлена');
                    location.href = 'data.php?page=disciplines';
                }
            }
        );
    }
});

$("#delete_discipline").click(function() {
    let discipline_name = $("#discipline_name").val();
    let discipline_form_title = $('#discipline_form_title').text();

    if (confirm('Вы действительно хотите удалить объект ' + discipline_form_title + ' "' + discipline_name +
            '"?')) {
        $.post(
            "/back/data/db_disciplines.php", {
                functionname: 'remove_discipline',
                id: $_GET('disid')
            },
            function(info) {
                if (info !== '1') {
                    alert(info);
                } else {
                    $('#discipline_form').modal('hide');
                    alert('Дисциплина удалена');
                    location.href = 'data.php?page=disciplines';
                }
            }
        );
    }
});
</script>