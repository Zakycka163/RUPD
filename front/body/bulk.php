<div class="px-4 py-3">
	<div class="row">
		<div class="col">
			<div class="card border-primary form-group" style="width: 35rem; height: 12rem">
				<div class="card-body">
					<h5 class="card-title">Массовое создание</h5>
                    <div class="input-group" style="width: 30rem;">
                        <select class="custom-select" id="bulk_type">
                            <option value="0" selected>Выбрать...</option>
                            <option value="1">Преподаватели</option>
                            <option value="2">Дисциплины</option>
                            <option value="3">Направления</option>
                            <option value="4">Трудовые функции</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button">Открыть</button>
                            <button class="btn btn-outline-success" type="button" disabled>Получить шаблон</button>
                        </div>
                    </div>
                </div>
				<div class="card-footer btn-group" >
                    <div class="input-group mb-2" style="width: 30rem;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputFile">Загрузить</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" accept=".xlsx" aria-describedby="inputFile">
                            <label class="custom-file-label" for="file" data-browse="Выбрать">Выбрать файл</label>
                        </div>
                    </div>
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