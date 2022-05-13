<div class="panel panel-primary">
    <div class="panel-heading">Поиск абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/finduser" method="get">
                    <select name="field"  class="form-control">
                        <option value="orgr">По названию организации</option>
                        <option value="username">По имени</option>
                        <option value="contract">По номеру договора</option>
                        <option value="account_num">По номеру счета</option>
                        <option value="inn">ИНН</option>
                        <option value="nomsf">Счет-фактура</option>
                        <option value="webdomains">По домену</option>
                        <option value="ip">По ip</option>
                    </select><br>
                    <input type="text" name="value" class="form-control">
                    <br><br>
                    <input type="submit" name="go" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
