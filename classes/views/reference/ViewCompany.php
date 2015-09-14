<?php

class ViewCompany {
        
        protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Контрагенты</legend>
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">код ЕДРПОУ</p>
                        <input type="text" name="edrpou" class="form-control w100" value="<?= $this->item_form->edrpou;?>">
                    </div>
                    <div class="form-group col-md-3"> 
                        <p class="p-form">форма собственности<p>
                        <select name="ownership" class="form-control w100">
<?php   foreach ($this->item_form->ownership as $ownership): ?>
                            <option value="<?= $ownership['id']?>"<?= $ownership['selected']?>><?= $ownership['abbr']?></option>
<?      endforeach;?>
                            <option onclick="location.href='/ownership/main'">добавить</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6"> 
                        <p class="p-form">название фирмы<p>
                        <input type="text" name="namecompany" class="form-control w100" value="<?= $this->item_form->namebank;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-10"> 
                        <p class="p-form">
                            юридический адрес<span style="font-size:0.8em;">(индекс::область::город::улица::дом::офис)</span>
                        </p>
                        <input type="text" name="regoffice" class="form-control w100" value="<?= $this->item_form->regoffice;?>">
                    </div>
                    <div class="form-group col-md-10"> 
                        <p class="p-form">
                            фактический адрес<span style="font-size:0.8em;">(индекс::область::город::улица::дом::офис)</span>
                        </p>
                        <input type="text" name="postaladress" class="form-control w100" value="<?= $this->item_form->postaladress;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <p class="p-form">плательщик НДС</p>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="vat" id="vatradio1" value="1" checked>
                                да
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="vat" id="vatradio2" value="0">
                                нет
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-2"> 
                        <p class="p-form">ИНН<p>
                        <input type="text" name="itn" class="form-control w100" value="<?= $this->item_form->itn;?>">
                    </div>
                    <div class="form-group col-md-5"> 
                        <p class="p-form">№ свидетельства<p>
                        <input type="text" name="sert_of_vat" class="form-control w100" value="<?= $this->item_form->sert_of_vat;?>">
                    </div>
                    <div class="col-md-2">
                        <p style="visibility: hidden;" class="p-form">bottom</p>
                        <button type="submit" class="btn btn-red">запомнить</button>
                    </div>
                </div>
<?php       $visibility = ' hidden';
            if($_SESSION['msgs']):
                $visibility = ' visible';
            endif;?>
                <div class="msgs <?= $visibility.$_SESSION['msgs'][1]?>">
                    <i class="fa fa-comments-o"></i><?= $_SESSION['msgs'][0]?>
                </div>
            </fieldset>
        </form>
<?php
    }
    
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
            <tr bgcolor="grey">
                <th align="center" width="6%">№ п/с</th>
                <th align="center" width="10%">ЕДРПОУ</th>
                <th align="center" width="30%">название фирмы</th>
                <th align="center" width="30%">юр.адрес</th>
                <th align="center" width="10%">инн</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/company/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->edrpou;?></td>
                <td align="left"><?= $line->ownershipabbr.' '.$line->namecompany;?></td>
                <td align="left"><?= $line->regoffice?></td>
                <td align="left"><?= $line->itn?></td>
                <td class="icon-edit">
                    <a href="/company/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/company/delete/id/<?= $line->id?>" title="удалить">
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>
            </tr>
<?          $count++;
        endforeach;?>   
        </table>
<?php   }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
