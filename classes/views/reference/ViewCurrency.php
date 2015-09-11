<?php

class ViewCurrency extends AbstractView{
    
        protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование должности</legend>
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">название валюты</p>
                        <input type="text" name="name" class="form-control w100" value="<?= $this->item_form->name;?>">
                    </div>
                    <div class="form-group col-md-2"> 
                        <p class="p-form">сокращение<p>
                        <input type="text" name="shortname" class="form-control w100" value="<?= $this->item_form->shortname;?>" title="например грн.">
                    </div>
                    <div class="form-group col-md-2"> 
                        <p class="p-form">код валюты<p>
                        <input type="text" name="code" class="form-control w100" value="<?= $this->item_form->code;?>" title="международный буквенный код например UAH">
                    </div>
                    <div class="form-group col-md-2"> 
                        <p class="p-form">цифровой код<p>
                        <input type="text" name="codenumber" class="form-control w100" value="<?= $this->item_form->codenumber;?>" title="цифровой код например для грн.-980">
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
                <th align="center" width="10%">№ п/с</th>
                <th align="center" width="25%">название</th>
                <th align="center" width="15%" title="например грн.">сокращение</th>
                <th align="center" width="15%" title="международный код например UAH">код</th>
                <th align="center" width="15%" title="цифровой код например для грн.-980">цифровой код</th>
                <th align="center" width="10%">ред...</th>
                <th align="center" width="10%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/currency/get/id/<?= $line->id?>';" class="hover-tr">
                <td align="center"><?= $count?></td>
                <td align="left"><?= $line->name?></td>
                <td align="left"><?= $line->shortname?></td>
                <td align="left"><?= $line->code?></td>
                <td align="left"><?= $line->codenumber?></td>
                <td class="icon-edit">
                    <a href="/currency/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/currency/delete/id/<?= $line->id?>" title="удалить">
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
