<?php

class ViewBanksfilial extends AbstractView {
        
     protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Рассчётные счета</legend>
                <div class="row">
                    <!--название филиала-->
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">название филиала</p>
                        <input type="text" name="name" class="form-control w100" value="<?= $this->item_form->name;?>">
                    </div>
                    <!--банк-->
                    <div class="form-group col-md-4"> 
                        <p class="p-form">банк где открыт счёт</p>
                        <select name="bank" class="form-control w100">
<?php   foreach ($this->item_form->bank as $bank): ?>
                            <option value="<?= $bank['bic']?>"<?= $bank['selected']?>>
                                <?= $bank['bic'].'::'.$bank['ownershipabbr'].' '.$bank['namebank']?>
                            </option>
<?      endforeach;?>
                            <option onclick="location.href='/banks/main'">добавить</option>
                        </select>
                    </div>
                    <!-- foreignKey справочника -->
                    <div class="col-md-1">
                        <input type="hidden" name="banks_bic" value="<?= $this->item_form->banks_bic;?>">
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
                <th align="center" width="50%">название филиала</th>
                <th align="center" width="30%">банк</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/banksfilial/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->name;?></td>
                <td align="left"><?= $line->bank_n?></td>
                <td class="icon-edit">
                    <a href="/banksfilial/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/banksfilial/delete/id/<?= $line->id?>" title="удалить">
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

