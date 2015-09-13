<?php

class ViewBanks extends AbstractView {
    
        protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование должности</legend>
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">МФО</p>
                        <input type="text" name="bic" class="form-control w100" value="<?= $this->item_form->bic;?>">
                    </div>
                    <div class="form-group col-md-3"> 
                        <p class="p-form">форма собственности<p>
                        <select name="ownership" class="form-control w100">
<?php   foreach ($this->item_form->ownership as $ownership): ?>
                            <option value="<?= $ownership['id']?>"<?= $ownership['selected']?>><?= $ownership['abbr']?></option>
<?      endforeach;?>
                            <option value="add"><a href="#">добавить</a></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6"> 
                        <p class="p-form">название банка<p>
                        <input type="text" name="namebank" class="form-control w100" value="<?= $this->item_form->namebank;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-9"> 
                        <p class="p-form">адрес банка<p>
                        <input type="text" name="adress" class="form-control w100" value="<?= $this->item_form->adress;?>">
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
                <th align="center" width="10%">МФО</th>
                <th align="center" width="10%">форма собств...</th>
                <th align="center" width="30%">название банка</th>
                <th align="center" width="30%">адрес банка</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/banks/get/id/<?= $line->id?>';" class="hover-tr">
                <td align="center"><?= $count?></td>
                <td align="left"><?= $line->bic?></td>
                <td align="left"><?= $line->ownershipabbr?></td>
                <td align="left"><?= $line->namebank?></td>
                <td align="left"><?= $line->adress?></td>
                <td class="icon-edit">
                    <a href="/banks/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/banks/delete/id/<?= $line->id?>" title="удалить">
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
