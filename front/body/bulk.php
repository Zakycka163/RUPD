<div class="px-4 py-3">
	<div class="row">
		<div class="col">
			<div class="card border-primary form-group" style="width: 35rem; height: 11rem">
				<div class="card-body">
					<h5 class="card-title">Массовое создание</h5>
                    <div class="input-group input-group-sm" style="width: 30rem;">
                        <select class="custom-select" id="bulk_type">
                            <option value="0" selected>Выбрать...</option>
                            <option value="1">Преподаватели</option>
                            <option value="2">Дисциплины</option>
                            <option value="3">Направления</option>
                            <option value="4">Трудовые функции</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="button" disabled style="width: 9rem;">Получить шаблон</button>
                        </div>
                    </div>
                </div>
				<div class="card-footer btn-group" hidden>
                    <form enctype="multipart/form-data" method="post">
                        <p class="btn-group" role="group" style="width: 30rem;">
                            <input type="file" name="file" accept=".xlsx" class="btn btn-secondary btn-sm">
                            <input type="submit" value="Загрузить" class="btn btn-success btn-sm">
                        </p>
                    </form>
                </div>
			</div>
		</div>	
	</div>
</div>
<form>
	<div class="px-4 py-3 bg-light">
        <div class="form-group">
			<h4 id="page_title">Загрузите xlsx файл</h3>
		</div>
    </div>
</form>	