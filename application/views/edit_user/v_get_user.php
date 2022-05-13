<?php foreach ($user as $key => $value):?>
<?php endforeach;?>
<h3 class=" text-center"><span class="text-primary">Форма редактирования абонента</span></h3>
<form action="/edituser" method="post">
    <div class="row">
        <div class="col-lg-4 text-right text-primary user_reg">Номер контракта:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="contract" size="70" 
                   value="<?php echo $value["contract"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата создания:</div>
        <div class="col-lg-6 text-left">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Дата создания: гг-мм-дд</span>
                <input type="text" name="cdate" size="70" 
                   value="<?php echo $value["cdate"] ;?>" class="form-control">
            </div>
<!--            <input type="text" name="cdate" size="70" 
                   value="<?php //echo $value["cdate"] ;?>" class="form-control">-->
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Имя абонента:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="username" size="70" 
                   value="<?php echo $value["username"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Организация:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="orgr" size="70" 
                       value="<?php echo $value["orgr"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Язык:</div>
        <div class="col-lg-6 text-left">
            <select name="language" class="form-control">
                <option value="Ru" 
                    <?php if("Ru" == $value["language"]) {echo "selected";} ;?>
                        >Ru</option>
                <option value="En"
                        <?php if("En" == $value["language"]) {echo "selected";} ;?>
                        >En</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Контактная почта:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="postmaster" size="70" 
                   value="<?php echo $value["postmaster"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="address_n" size="70" 
                   value="<?php echo $value["address_n"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="address_e" size="70" 
                   value="<?php echo $value["address_e"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        
        <div class="col-lg-4 text-right text-primary user_reg">Тип лица:</div>
        <div class="col-lg-6 text-left">
            <select name="urfiz" class="form-control">
                <option value="Юридическое"
                        <?php if("Юридическое" == $value["urfiz"]){echo "selected";} ;?>
                        >Юридическое</option>
                <option value="Физическое"
                        <?php if("Физическое" == $value["urfiz"]){echo "selected";} ;?>
                        >Физическое</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Телефоны:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="phones" size="70" 
                       value="<?php echo $value["phones"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Факс:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="fax" size="70" 
                       value="<?php echo $value["fax"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Контактное лицо:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="contactperson" size="70" 
                   value="<?php echo $value["contactperson"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Паспортные данные:</div>
        <div class="col-lg-6 text-left">
            <input type="text" name="passport" size="70" 
                   value="<?php echo $value["passport"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Номер счета:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="account_num" size="70" 
                       value="<?php echo $value["account_num"] ;?>" class="form-control">
        </div>    
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Банк:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="bankdetails" size="70" 
                       value="<?php echo $value["bankdetails"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">ИНН:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="inn" size="70" 
                       value="<?php echo $value["inn"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        
<!--        <div class="col-lg-4 text-right text-primary user_reg">ОКОНХ:</div>
        <div class="col-lg-6 text-left">-->
<input type="hidden" name="okonx" size="70" 
                       value="<?php echo $value["okonx"] ;?>" class="form-control">
<!--        </div>
        <div class="col-lg-2"></div>-->
        
        
        <div class="col-lg-4 text-right text-primary user_reg">МФО:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="mfo" size="70" 
                       value="<?php echo $value["mfo"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">ОКЕД:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="oked" size="70" 
                       value="<?php echo $value["oked"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Регистрационный код НДС:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="rkpnds" size="70" 
                       value="<?php echo $value["rkpnds"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">SWIFT:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="swift" size="70" 
                       value="<?php echo $value["swift"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Order ID:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="orderid" size="70" 
                       value="<?php echo $value["orderid"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод доставки:</div>
        <div class="col-lg-6 text-left">
            <select name="delivmethod" class="form-control">
                <option value="Courier" 
                        <?php if("Courier" == $value["delivmethod"]){echo "selected";} ;?>
                        >Courier
                </option>
                <option value="Fax"
                        <?php if("Fax" == $value["delivmethod"]){echo "selected";} ;?>
                        >Fax
                </option>
                <option value="Leg"
                        <?php if("Leg" == $value["delivmethod"]){echo "selected";} ;?>
                        >Leg
                </option>
                <option value="No"
                        <?php if("No" == $value["delivmethod"]){echo "selected";} ;?>
                        >Без доставки
                </option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес доставки:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="delivaddress" size="70" 
                       value="<?php echo $value["delivaddress"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Статус:</div>
        <div class="col-lg-6 text-left">
            <select name="status" class="form-control" class="form-control">
                <option value="Enable"
                        <?php if("Enable" == $value["status"]){echo "selected";} ;?>
                        >Enable</option>
                <option value="Disable"
                        <?php if("Disable" == $value["status"]){echo "selected";} ;?>
                        >Disable</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата регистрации:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="regdate" size="70" 
                       value="<?php echo $value["regdate"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Зарегистрированн:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="registredby" size="70" 
                       value="<?php echo $value["registredby"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод оплаты:</div>
        <div class="col-lg-6 text-left">
            <select name="paymentmethod" class="form-control">
                <option value="Bank"
                        <?php if("Bank" == $value["paymentmethod"]){echo "selected";} ;?>
                        >Bank</option>
                <option value="Office"
                        <?php if("Office" == $value["paymentmethod"]){echo "selected";} ;?>
                        >Office
                </option>
                <option value="Usd"
                        <?php if("Usd" == $value["paymentmethod"]){echo "selected";} ;?>
                        >Usd
                </option>
                <option value="Euro"
                        <?php if("Euro" == $value["paymentmethod"]){echo "selected";} ;?>
                        >Euro
                </option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Предоплата:</div>
        <div class="col-lg-6 text-left">
            <select name="prepayment" class="form-control">
                <option value="Yes"
                        <?php if("Yes" == $value["prepayment"]){echo "selected";} ;?>
                        >Yes
                </option>
                <option value="No"
                        <?php if("No" == $value["prepayment"]){echo "selected";} ;?>
                        >No
                </option>
                <option value=""
                        <?php if("" == $value["prepayment"]){echo "selected";} ;?>
                        >
                </option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Метод отключения:</div>
        <div class="col-lg-6 text-left">
            <select name="lockingmode" class="form-control">
                <option value="Manual"
                        <?php if("Manual" == $value["lockingmode"]){echo "selected";} ;?>
                        >Manual
                </option>
                <option value="Automatic"
                        <?php if("Automatic" == $value["lockingmode"]){echo "selected";} ;?>
                        >Automatic
                </option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Дата последней модификации:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="lastmodified" size="70" 
                       value="<?php echo date("Y-m-d H:i:s") ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Изменено:</div>
        <div class="col-lg-6 text-left">
                <input type="text" size="70" 
                       value="<?php echo $value["modifiedby"];//Cookie::get('user');?>" class="form-control">
                <input type="hidden" name="modifiedby" value="<?php echo Cookie::get('user');?>">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Веб домены:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="webdomains" size="70" 
                       value="<?php echo $value["webdomains"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Анлим:</div>
        <div class="col-lg-6 text-left">
            <select name="unlim" class="form-control">
                <option value="N"
                        <?php if("N" == $value["unlim"]){echo "selected";} ;?>
                        >N</option>
                <option value="Y"
                        <?php if("Y" == $value["unlim"]){echo "selected";} ;?>
                        >Y</option>
                <option value="P"
                        <?php if("P" == $value["unlim"]){echo "selected";} ;?>
                        >P</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Коментарии:</div>
        <div class="col-lg-6 text-left">
            <textarea rows="3" cols="45" name="coment" 
                class="form-control"><?php echo $value["coment"] ;?></textarea>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">План (лимит трафика):</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="plan" size="70" 
                       value="<?php echo $value["plan"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Цена:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="prise" size="70" 
                       value="<?php echo $value["prise"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">НДС</div>
        <div class="col-lg-6 text-left">
            <select name="nds" class="form-control">
                <option value="y"
                        <?php if("y" == $value["nds"]){echo "selected";} ;?>
                        >y</option>
                <option value="n"
                        <?php if("n" == $value["nds"]){echo "selected";} ;?>
                        >n</option>
            </select>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Ставка НДС / Код льготы</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="stavkands" size="70" 
                       value="<?php echo $value["stavkands"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Скидка:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="skidka" size="70" 
                       value="<?php echo $value["skidka"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Скорость:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="speed" size="70" 
                       value="<?php echo $value["speed"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Цена превышения трафика:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="price_out" size="70" 
                       value="<?php echo $value["price_out"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Адрес подключения:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="addr_podkl" size="70" 
                       value="<?php echo $value["addr_podkl"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">IP адрес:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="ip_addr" size="70" 
                       value="<?php echo $value["ip_addr"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">СПД</div>
        <div class="col-lg-6 text-left">
            <select name="spd" class="form-control">
                <option value="y"
                        <?php if("n" == $value["spd"]){echo "selected";} ;?>
                        >y
                </option>
                <option value="n"
                        <?php if("n" == $value["spd"]){echo "selected";} ;?>
                        >n
                </option>
            </select>
        </div>
        <div class="col-lg-4 text-right text-primary user_reg">АТС:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="ats" size="70" 
                       value="<?php echo $value["ats"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Порт:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="port" size="70" 
                       value="<?php echo $value["port"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        
        <div class="col-lg-4 text-right text-primary user_reg">Оборудование:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="oborudovanie" size="70" 
                       value="<?php echo $value["oborudovanie"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Свой</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="s" size="70" 
                       value="<?php echo $value["s"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 text-right text-primary user_reg">Считать/не считать</div>
        <div class="col-lg-6 text-left">
                <select name="feecheck" class="form-control">
                    <option value="yes"
                            <?php if("yes" == $value["feecheck"]){echo "selected";} ;?>
                            >yes
                    </option>
                    <option value="no"
                            <?php if("no" == $value["feecheck"]){echo "selected";} ;?>
                            >no
                    </option>
                </select>
        </div>
        <div class="col-lg-2"></div>
        
        
        
        
<!--        <div class="col-lg-4 text-right text-primary user_reg">BCC:</div>
        <div class="col-lg-6 text-left">
                <input type="text" name="s" size="70" 
                       value="<?php //echo $value["s"] ;?>" class="form-control">
        </div>
        <div class="col-lg-2"></div>-->
    </div>
    <br><br>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <p class="text-primary">Дополнительные услуги абонента</p>
                <select name="service" class="form-control">
                    <option value="">Выберите услугу</option>
                    <?php foreach ($services as $key => $value1): ?>
                        <option value="<?php echo $value1['id']; ?>">
                            <?php echo $value1['service'], " | ", $value1['price']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <br><br>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-4">
                <p class="text-primary">Удалить дополнительные услуги абонента</p>
                <table class="table table-striped">
                    <?php foreach ($servis as $key => $value2): ?>
                       <tr>
                            <td>
                                <p><?php echo $value2['service'], " | ", $value2['price']; ?></p>
                            </td>
                            <td class="text-right">
                                <input type="checkbox" name="delserv[]" value="<?php echo $value2['id']; ?>" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-4">
                <p class="text-primary">Разовые услуги абонента</p>
                
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Наименование услуги</span>
                    <input type="text" name="one_service" class="form-control" aria-describedby="basic-addon1"/>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Цена</span>
                    <input type="text" name="one_price" class="form-control" aria-describedby="basic-addon2" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Колличество</span>
                    <input type="text" name="one_count" class="form-control"  value="1" aria-describedby="basic-addon3"/>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Ед. измерения</span>
                    <select name="one_unit" class="form-control">
                        <option value="Штука">Штука</option>
                        <option value="Метр">Метр</option>
                        <option value="Человек/час">Человек/час</option>
                        <option value="День">День</option>
                        <option value="Месяц">Месяц</option>
                        <option value="Мегабайт">Мегабайт</option>
                        <option value="Год">Год</option>
                        <option value="year">year</option>
                    </select>
                    
<!--                    <span class="input-group-addon" id="basic-addon4">Ед. измерения</span>
                    <input type="text" name="one_unit" class="form-control"  value="месяц" aria-describedby="basic-addon4"/>-->
                    
                    
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">Месяц</span>
                    <input type="text" name="one_data" class="form-control" value="<?php
                    $data = getdate();
                    //echo $data['mday'] . "-" . $data['mon'] . "-" . $data['year'];
                    echo $data['mon'];
                    ?>" aria-describedby="basic-addon5"/>
                </div>
                
                
                
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-4">
                <p class="text-primary">Удаление разовой услуги абонента</p>
                <table class="table table-striped">
                    <?php foreach ($one_servis as $one_key => $one_value): ?>
                       <tr>
                            <td>
                                <p><?php echo $one_value['service']; ?></p>
                            </td>
                            <td class="text-right">
                                <input type="checkbox" name="deloneserv[]" value="<?php echo $one_value['id']; ?>" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <br><br>
        <div class="col-lg-4 text-center col-lg-offset-3">
            <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
        </div>
        <div class="col-lg-4 text-left">
            <a href="/edituser?user_name_text=<?php echo $value["username"] ;?>&go=Показать" class="btn btn-primary">Сбросить</a>
        </div>
    <br>
    <br><br><br><br><br>
</form>