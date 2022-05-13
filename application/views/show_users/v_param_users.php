<div class="panel panel-primary">
    <div class="panel-heading">Выборка абонентов</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form name="allusers" action="allusers" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td>Оплата перечеслением</td>
                            <td><input type="checkbox" name="nooffice" checked/></td>
                        </tr>
                        <tr>
                            <td>Оплата наличными</td>
                            <td><input type="checkbox" name="office" checked/></td>
                        </tr>
                        <tr>
                            <td>USD</td>
                            <td><input type="checkbox" name="usd" checked/></td>
                        </tr>
                        <tr>
                            <td>Официальные</td>
                            <td><input type="checkbox" name="s" checked/></td>
                        </tr>
                        <tr>
                            <td>Не официальные</td>
                            <td><input type="checkbox" name="nos" checked/></td>
                        </tr>
                        <tr>
                            <td>Анлим</td>
                            <td><input type="checkbox" name="unlim" checked/></td>
                        </tr>
                        <tr>
                            <td>План</td>
                            <td><input type="checkbox" name="nounlim" checked/></td>
                        </tr>
                        <tr>
                            <td>Не СПД</td>
                            <td><input type="checkbox" name="spd" checked/></td>
                        </tr>
                        <tr>
                            <td>СПД</td>
                            <td><input type="checkbox" name="nospd" checked/></td>
                        </tr>
                        <tr>
                            <td>Доп. услуги</td>
                            <td><input type="checkbox" name="dopu"/></td>
                        </tr>
                        <tr>
                            <td>Юридические</td>
                            <td><input type="checkbox" name="ur" checked/></td>
                        </tr>
                        <tr>
                            <td>Физические</td>
                            <td><input type="checkbox" name="fiz" checked/></td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td>Услуги</td>
                            <td><input type="checkbox" name="coment" checked/></td>
                        </tr>
                        <tr>
                            <td>Трафик</td>
                            <td><input type="checkbox" name="plan" checked/></td>
                        </tr>
                        <tr>
                            <td>Цена</td>
                            <td><input type="checkbox" name="prise" checked/></td>
                        </tr>
                        <tr>
                            <td>Оплата</td>
                            <td><input type="checkbox" name="paymentmethod" checked/></td>
                        </tr>
                        <tr>
                            <td>IP адрес</td>
                            <td><input type="checkbox" name="ip_addr" checked/></td>
                        </tr>
                        <tr>
                            <td>АТС</td>
                            <td><input type="checkbox" name="ats" checked/></td>
                        </tr>
                        <tr>
                            <td>Порт</td>
                            <td><input type="checkbox" name="port" checked/></td>
                        </tr>
                        <tr>
                            <td>Оборудование</td>
                            <td><input type="checkbox" name="oborudovanie" checked/></td>
                        </tr>
                    </table>
                    
                    <div class="row text-center">
                        <input class="btn btn-primary" type="submit" name="show" value="Показать">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>