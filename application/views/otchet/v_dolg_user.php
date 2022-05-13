<div class="panel panel-primary">
    <div class="panel-heading">ДОЛЖНИКИ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/dolshniki" method="post">
                    <select class="form-control" name="type">
                        <option value="1">Без ограничения по трафику</option>
                        <option value="2">USD</option>
                        <option value="3">С ограниченным трафиком</option>
                        <option value="4">EURO</option>
                    </select>
                    <br>
                    <select class="form-control" name="pay">
                        <option value="Yes">По предоплате</option>
                        <option value="No">По факту</option>
                        <option value="All">Все</option>
                    </select>
                    <br><br>
                    <input type="submit" name="go" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
