<div class="helpform">
    <form class="uk-form-stacked uk-grid-small" method="post" name="helpform" uk-grid>
        <input type="hidden" name="helpform" value="1">
        <input type="hidden" name="site_name" value="[[++site_name]]">
        <input type="hidden" name="site_url" value="[[++site_url]]">
        <div class="uk-margin uk-width-1-2@s">
            <label class="uk-form-label">Ваше имя</label>
            <div class="uk-form-controls">
                <input type="text" name="name" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin uk-width-1-2@s">
            <label class="uk-form-label">Email</label>
            <div class="uk-form-controls">
                <input type="text" name="email" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin uk-width-1-1">
            <div class="uk-form-label">Вопрос (краткий)</div>
            <div class="uk-form-controls">
                <input type="text" name="question" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin uk-width-1-1">
            <div class="uk-form-label">Вопрос (подробный)</div>
            <div class="uk-form-controls">
                <textarea name="longquestion" id="" rows="5" class="uk-textarea" required></textarea>
            </div>
        </div>
        <div class="uk-margin uk-width-1-2@s">
            <div class="uk-form-label"></div>
            <div class="uk-form-controls">
                <button type="submit" class="uk-button uk-button-primary">Задать вопрос</button>
            </div>
        </div>
        <div class="uk-margin uk-width-1-2@s">
            <div class="uk-form-label"></div>
            <div class="uk-form-controls">
                <input type="checkbox" name="log" class="uk-checkbox"> Отправить error.log
            </div>
        </div>
    </form>

    <div id="helpform-panel-home-div"></div>

</div>