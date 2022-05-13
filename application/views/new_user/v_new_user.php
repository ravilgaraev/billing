<h3 class=" text-center"><span class="text-primary">Добавление абонента</span></h3>
<form action="/newuser" method="post">
    <div class="row">
        <div class="col-lg-4 text-right text-primary user_reg">Номер контракта:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="contract" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата создания: (ГГГГ-ММ-ДД)</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="cdate" size="70" 
                   value="<?php echo date("Y-m-d");?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Название абонента:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="username" size="70" 
                   value="<?php echo $username; ?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
         <div class="col-lg-4 text-right text-primary user_reg">Организация:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="orgr" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Язык:</div>
        <div class="col-lg-6 text-left">
            <select name="language" class="form-control">
                <option value="Ru">Ru</option>
                <option value="En">En</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Контактная почта:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="postmaster" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="address_n" size="70" 
                   value="" placeholder="по русски" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="address_e" size="70" 
                   value="" placeholder="по английки" class="form-control">
        </div>
        <div class="col-lg-2"></div>
       
        <div class="col-lg-4 text-right text-primary user_reg">Тип лица:</div>
        <div class="col-lg-6 text-left">
            <select name="urfiz" class="form-control">
                <option value="Юридическое">Юридическое</option>
                <option value="Физическое">Физическое</option>
            </select>
        </div>
        <div class="col-lg-4 text-right text-primary user_reg">Телефоны:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="phones" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Факс:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="fax" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Контактное лицо:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="contactperson" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Паспортные данные:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="passport" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Номер счета:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="account_num" size="70" value="" class="form-control">
        </div>    
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Банк:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="bankdetails" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">ИНН:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="inn" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        
<!--        <div class="col-lg-4 text-right text-primary user_reg">ОКОНХ:</div>
        <div class="col-lg-6 text-left">-->
<input type="hidden" name="okonx" size="70" value="" class="form-control">
        <!--</div>-->
        <!--<div class="col-lg-2"></div>-->
        
        <div class="col-lg-4 text-right text-primary user_reg">МФО:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="mfo" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">ОКЕД:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="oked" size="70" 
                       value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Регистрационный код НДС:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="rkpnds" size="70" 
                       value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">SWIFT:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="swift" size="70" 
                       value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Order ID:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="orderid" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод доставки:</div>
        <div class="col-lg-6 text-left">
            <select name="delivmethod" class="form-control">
                <option value="Courier">Courier</option>
                <option value="Fax">Fax</option>
                <option value="Leg">Leg</option>
                <option value="No">Без доставки</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес доставки:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="delivaddress" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Статус:</div>
        <div class="col-lg-6 text-left">
            <select name="status" class="form-control" class="form-control">
                <option value="Enable">Enable</option>
                <option value="Disable">Disable</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата регистрации:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="regdate" size="70" 
                   value="<?php echo date("Y-m-d H:i:s");?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Зарегистрированн:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="registredby" size="70" 
                   value="<?php echo Cookie::get('user');?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод оплаты:</div>
        <div class="col-lg-6 text-left">
            <select name="paymentmethod" class="form-control">
                <option value="Bank">Bank</option>
                <option value="Office">Office</option>
                <option value="Usd">Usd</option>
                <option value="Euro">Euro</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Предоплата:</div>
        <div class="col-lg-6 text-left">
            <select name="prepayment" class="form-control">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод отключения:</div>
        <div class="col-lg-6 text-left">
            <select name="lockingmode" class="form-control">
                <option value="Manual">Manual</option>
                <option value="Automatic">Automatic</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата последней модификации:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="lastmodified" size="70" 
                   value="<?php echo date("Y-m-d H:i:s");?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Изменено:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="modifiedby" size="70" 
                       value="<?php echo Cookie::get('user');?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Веб домены:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="webdomains" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Анлим:</div>
        <div class="col-lg-6 text-left">
            <select name="unlim" class="form-control">
                <option value="Y">Y</option>
                <option value="N">N</option>
                <option value="P">PPP</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Коментарии:</div>
        <div class="col-lg-6 text-left">
            <textarea rows="3" cols="45" name="coment" 
                class="form-control"></textarea>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">План:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="plan" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Цена:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="prise" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">НДС</div>
        <div class="col-lg-6 text-left">
            <select name="nds" class="form-control">
                <option value="y">y</option>
                <option value="n">n</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Ставка НДС / Код льготы</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="stavkands" size="70" 
                       value="15" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Скидка:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="skidka" size="70" 
                       value="<?php echo 1 ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Скорость:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="speed" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Цена превышения трафика:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="price_out" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес подключения:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="addr_podkl" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">IP адрес:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="ip_addr" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">СПД:</div>
        <div class="col-lg-6 text-left">
            <select name="spd" class="form-control">
                <option value="n">n</option>
                <option value="y">y</option>
            </select>
        </div>
        <div class="col-lg-4 text-right text-primary user_reg">АТС:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="ats" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Порт:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="port" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Оборудование:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="oborudovanie" size="70" value="" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Считать/не считать</div>
        <div class="col-lg-6 text-left">
                <select name="feecheck" class="form-control">
                    <option value="yes">yes</option>
                    <option value="no">no</option>
                </select>
        </div>
        <div class="col-lg-2"></div>
<!--        <div class="col-lg-4 text-right text-primary user_reg">BCC:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="s" size="70" value="n" class="form-control">
        </div>
        <div class="col-lg-2"></div>-->
    </div>
    <br>
    <div class="text-center">
        <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
    </div>
    <br><br><br><br><br>
</form>