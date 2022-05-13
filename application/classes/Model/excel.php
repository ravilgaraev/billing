<?php
    $as->getStyle("A1:BH4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $as->getStyle("A1:BH4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $as->getStyle("A1:BH4")->getAlignment()->setWrapText(true);
    
    $as->mergeCells("A1:A3");
    $as->setCellValueExplicit("A1", 'п.п.','s');
    
    $as->mergeCells("B1:B3");
    $as->setCellValueExplicit("B1", 'Тип счета-фактуры','s');
    
    $as->mergeCells("C1:C3");
    $as->setCellValueExplicit("C1", 'Код типа одностороннего счета-фактуры','s');
    
    $as->mergeCells("D1:E1");
    $as->setCellValueExplicit("D1", 'Счет-фактура','s');
    
    $as->mergeCells("D2:D3");
    $as->setCellValueExplicit("D2", '№','s');
    $as->mergeCells("E2:E3");
    $as->setCellValueExplicit("E2", 'Дата','s');
    
    $as->mergeCells("D1:E1");
    $as->setCellValueExplicit("D1", 'Счет-фактура','s');
    
    $as->mergeCells("F1:G1");
    $as->setCellValueExplicit("F1", 'Договор','s');
    
    $as->mergeCells("F2:F3");
    $as->setCellValueExplicit("F2", '№','s');
    $as->mergeCells("G2:G3");
    $as->setCellValueExplicit("G2", 'Дата','s');
    
    $as->mergeCells("H1:K1");
    $as->setCellValueExplicit("H1", 'Доверенность','s');
    
    $as->mergeCells("H2:H3");
    $as->setCellValueExplicit("H2", '№','s');
    $as->mergeCells("I2:I3");
    $as->setCellValueExplicit("I2", 'Дата','s');
    $as->mergeCells("J2:J3");
    $as->setCellValueExplicit("J2", 'ФИО','s');
    $as->mergeCells("K2:K3");
    $as->setCellValueExplicit("K2", 'ИНН','s');
    
    $as->mergeCells("L1:L3");
    $as->setCellValueExplicit("L1", 'Товар отпустил (ФИО)','s');
    
    $as->mergeCells("M1:Z1");
    $as->setCellValueExplicit("M1", 'Исполнитель','s');
    
    $as->mergeCells("M2:M3");
    $as->setCellValueExplicit("M2", 'Наименование','s');
    $as->mergeCells("N2:N3");
    $as->setCellValueExplicit("N2", 'ИНН','s');
    $as->mergeCells("O2:O3");
    $as->setCellValueExplicit("O2", 'Код филиала','s');
    $as->mergeCells("P2:P3");
    $as->setCellValueExplicit("P2", 'Название филиала','s');
    $as->mergeCells("Q2:Q3");
    $as->setCellValueExplicit("Q2", 'Расчетный счет','s');
    $as->mergeCells("R2:R3");
    $as->setCellValueExplicit("R2", 'МФО','s');
    $as->mergeCells("S2:S3");
    $as->setCellValueExplicit("S2", 'Адрес','s');
    $as->mergeCells("T2:T3");
    $as->setCellValueExplicit("T2", 'Телефон','s');
    $as->mergeCells("U2:U3");
    $as->setCellValueExplicit("U2", 'Мобильный','s');
    $as->mergeCells("V2:V3");
    $as->setCellValueExplicit("V2", 'ОКЭД','s');
    $as->mergeCells("W2:W3");
    $as->setCellValueExplicit("W2", 'Район (код)','s');
    $as->mergeCells("X2:X3");
    $as->setCellValueExplicit("X2", 'Директор','s');
    $as->mergeCells("Y2:Y3");
    $as->setCellValueExplicit("Y2", 'Гл.бухгалтер','s');
    $as->mergeCells("Z2:Z3");
    $as->setCellValueExplicit("Z2", 'Код плательщика НДС','s');
    
    $as->mergeCells("AA1:AN1");
    $as->setCellValueExplicit("AA1", 'Заказчик','s');
    
    $as->mergeCells("AA2:AA3");
    $as->setCellValueExplicit("AA2", 'Наименование','s');
    $as->mergeCells("AB2:AB3");
    $as->setCellValueExplicit("AB2", 'ИНН','s');
    $as->mergeCells("AC2:AC3");
    $as->setCellValueExplicit("AC2", 'Код филиала','s');
    $as->mergeCells("AD2:AD3");
    $as->setCellValueExplicit("AD2", 'Название филиала','s');
    $as->mergeCells("AE2:AE3");
    $as->setCellValueExplicit("AE2", 'Расчетный счет','s');
    $as->mergeCells("AF2:AF3");
    $as->setCellValueExplicit("AF2", 'МФО','s');
    $as->mergeCells("AG2:AG3");
    $as->setCellValueExplicit("AG2", 'Адрес','s');
    $as->mergeCells("AH2:AH3");
    $as->setCellValueExplicit("AH2", 'Телефон','s');
    $as->mergeCells("AI2:AI3");
    $as->setCellValueExplicit("AI2", 'Мобильный','s');
    $as->mergeCells("AJ2:AJ3");
    $as->setCellValueExplicit("AJ2", 'ОКЭД','s');
    $as->mergeCells("AK2:AK3");
    $as->setCellValueExplicit("AK2", 'Район (код)','s');
    $as->mergeCells("AL2:AL3");
    $as->setCellValueExplicit("AL2", 'Директор','s');
    $as->mergeCells("AM2:AM3");
    $as->setCellValueExplicit("AM2", 'Гл.бухгалтер','s');
    $as->mergeCells("AN2:AN3");
    $as->setCellValueExplicit("AN2", 'Код плательщика НДС','s');
    
    $as->mergeCells("AO1:BH1");
    $as->setCellValueExplicit("AO1", 'Товары (услуги)','s');
    
    $as->mergeCells("AO2:AO3");
    $as->setCellValueExplicit("AO2", 'п.п.','s');
    $as->mergeCells("AP2:AP3");
    $as->setCellValueExplicit("AP2", 'Наименование комитента','s');
    $as->mergeCells("AQ2:AQ3");
    $as->setCellValueExplicit("AQ2", 'ИНН комитента','s');
    $as->mergeCells("AR2:AR3");
    $as->setCellValueExplicit("AR2", 'Рег. код платель. НДС комитента','s');
    $as->mergeCells("AS2:AS3");
    $as->setCellValueExplicit("AS2", 'Наименование','s');
    $as->mergeCells("AT2:AT3");
    $as->setCellValueExplicit("AT2", 'Идентификационный код и название по Единому электронному национальному каталогу товаров (услуг)','s');
    $as->mergeCells("AU2:AU3");
    $as->setCellValueExplicit("AU2", 'Штрих код товара/услуги','s');
    $as->mergeCells("AV2:AV3");
    $as->setCellValueExplicit("AV2", 'Серия товара','s');
    $as->mergeCells("AW2:AW3");
    $as->setCellValueExplicit("AW2", 'Ед. изм. (код)','s');
    $as->mergeCells("AX2:AX3");
    $as->setCellValueExplicit("AX2", 'Базовая цена','s');
    $as->mergeCells("AY2:AY3");
    $as->setCellValueExplicit("AY2", '% добавочной стоимости','s');
    $as->mergeCells("AZ2:AZ3");
    $as->setCellValueExplicit("AZ2", 'Кол-во','s');
    $as->mergeCells("BA2:BA3");
    $as->setCellValueExplicit("BA2", 'Цена','s');
    
    $as->mergeCells("BB2:BC2");
    $as->setCellValueExplicit("BB2", 'Акцизный налог','s');
    $as->setCellValueExplicit("BB3", 'Ставка','s');
    $as->setCellValueExplicit("BC3", 'Сумма','s');
    
    $as->mergeCells("BD2:BD3");
    $as->setCellValueExplicit("BD2", 'Стоимость поставки','s');
    
    $as->mergeCells("BE2:BF2");
    $as->setCellValueExplicit("BE2", 'НДС','s');
    $as->setCellValueExplicit("BE3", 'Ставка','s');
    $as->setCellValueExplicit("BF3", 'Сумма','s');
    
    $as->mergeCells("BG2:BG3");
    $as->setCellValueExplicit("BG2", 'Стоимость поставки с учетом НДС','s');
    
    $as->mergeCells("BH2:BH3");
    $as->setCellValueExplicit("BH2", 'Код Льготы','s');
    
//-----------------------------------------------------
    
    $as->setCellValueExplicit("A4", 1,'s');
    $as->setCellValueExplicit("B4", 2,'s');
    $as->setCellValueExplicit("C4", 3,'s');
    $as->setCellValueExplicit("D4", 4,'s');
    $as->setCellValueExplicit("E4", 5,'s');
    $as->setCellValueExplicit("F4", 6,'s');
    $as->setCellValueExplicit("G4", 7,'s');
    $as->setCellValueExplicit("H4", 8,'s');
    $as->setCellValueExplicit("I4", 9,'s');
    $as->setCellValueExplicit("J4", 10,'s');
    $as->setCellValueExplicit("K4", 11,'s');
    $as->setCellValueExplicit("L4", 12,'s');
    $as->setCellValueExplicit("M4", 13,'s');
    $as->setCellValueExplicit("N4", 14,'s');
    $as->setCellValueExplicit("O4", 15,'s');
    $as->setCellValueExplicit("P4", 16,'s');
    $as->setCellValueExplicit("Q4", 17,'s');
    $as->setCellValueExplicit("R4", 18,'s');
    $as->setCellValueExplicit("S4", 19,'s');
    $as->setCellValueExplicit("T4", 20,'s');
    $as->setCellValueExplicit("U4", 21,'s');
    $as->setCellValueExplicit("V4", 22,'s');
    $as->setCellValueExplicit("W4", 23,'s');
    $as->setCellValueExplicit("X4", 24,'s');
    $as->setCellValueExplicit("Y4", 25,'s');
    $as->setCellValueExplicit("Z4", 26,'s');
    $as->setCellValueExplicit("AA4", 27,'s');
    $as->setCellValueExplicit("AB4", 28,'s');
    $as->setCellValueExplicit("AC4", 29,'s');
    $as->setCellValueExplicit("AD4", 30,'s');
    $as->setCellValueExplicit("AE4", 31,'s');
    $as->setCellValueExplicit("AF4", 32,'s');
    $as->setCellValueExplicit("AG4", 33,'s');
    $as->setCellValueExplicit("AH4", 34,'s');
    $as->setCellValueExplicit("AI4", 35,'s');
    $as->setCellValueExplicit("AJ4", 36,'s');
    $as->setCellValueExplicit("AK4", 37,'s');
    $as->setCellValueExplicit("AL4", 38,'s');
    $as->setCellValueExplicit("AM4", 39,'s');
    $as->setCellValueExplicit("AN4", 40,'s');
    $as->setCellValueExplicit("AO4", 41,'s');
    $as->setCellValueExplicit("AP4", 42,'s');
    $as->setCellValueExplicit("AQ4", 43,'s');
    $as->setCellValueExplicit("AR4", 44,'s');
    $as->setCellValueExplicit("AS4", 45,'s');
    $as->setCellValueExplicit("AT4", 46,'s');
    $as->setCellValueExplicit("AU4", 47,'s');
    $as->setCellValueExplicit("AV4", 48,'s');
    $as->setCellValueExplicit("AW4", 49,'s');
    $as->setCellValueExplicit("AX4", 50,'s');
    $as->setCellValueExplicit("AY4", 51,'s');
    $as->setCellValueExplicit("AZ4", 52,'s');
    $as->setCellValueExplicit("BA4", 53,'s');
    $as->setCellValueExplicit("BB4", 54,'s');
    $as->setCellValueExplicit("BC4", 55,'s');
    $as->setCellValueExplicit("BD4", 56,'s');
    $as->setCellValueExplicit("BE4", 57,'s');
    $as->setCellValueExplicit("BF4", 58,'s');
    $as->setCellValueExplicit("BG4", 59,'s');
    $as->setCellValueExplicit("BH4", 60,'s');
    