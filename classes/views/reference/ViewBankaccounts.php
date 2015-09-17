<?php

class ViewBankaccounts extends AbstractView {
    
     protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Рассчётные счета</legend>
                <div class="row">
                    <!--номер счёта-->
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">№ счёта</p>
                        <input type="text" name="numberaccount" class="form-control w100" value="<?= $this->item_form->numberaccount;?>">
                    </div>
                    <!--назначение счёта-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">назначение счёта<p>
                        <select name="status" class="form-control w100">
<?php   foreach ($this->item_form->status as $status): ?>
                            <option value="<?= $status['id']?>"<?= $status['selected']?>><?= $status['namestatus']?></option>
<?      endforeach;?>
                            <option onclick="location.href='/accountstatus/main'">добавить</option>
                        </select>
                    </div>
                    <!--валюта-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">валюта<p>
                        <select name="currency" class="form-control w100">
<?php   foreach ($this->item_form->currency as $currency): ?>
                            <option value="<?= $currency['id']?>"<?= $currency['selected']?>><?= $currency['code'].'::'.$currency['shortname']?></option>
<?      endforeach;?>
                            <option onclick="location.href='/currency/main'">добавить</option>
                        </select>
                    </div>
                </div>
                <div class="row">
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
                    <!--фирма-->
                    <div class="form-group col-md-4"> 
                        <p class="p-form">фирма-владелец счёта</p>
                        <select name="company" class="form-control w100">
<?php   foreach ($this->item_form->company as $company): ?>
                            <option value="<?= $company['edrpou']?>"<?= $company['selected']?>>
                                <?= $company['edrpou'].'::'.$company['ownershipabbr'].' '.$company['namecompany']?>
                            </option>
<?      endforeach;?>
                            <option onclick="location.href='/company/main'">добавить</option>
                        </select>
                    </div>
                    <!-- foreignKey справочника -->
                    <div class="col-md-1">
                        <input type="hidden" name="company_edrpou" value="<?= $this->item_form->company_edrpou;?>">
                        <input type="hidden" name="accountstatus_id" value="<?= $this->item_form->accountstatus_id;?>">
                        <input type="hidden" name="currency_id" value="<?= $this->item_form->currency_id;?>">
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
                <th align="center" width="20%">счёт</th>
                <th align="center" width="10%">статус</th>
                <th align="center" width="10%">валюта</th>
                <th align="center" width="20%">банк</th>
                <th align="center" width="20%">фирма</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/bankaccounts/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->numberaccount;?></td>
                <td align="left"><?= $line->status_n;?></td>
                <td align="left"><?= $line->currency_n?></td>
                <td align="left"><?= $line->bank_n?></td>
                <td align="left"><?= $line->company_n?></td>
                <td class="icon-edit">
                    <a href="/bankaccounts/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/bankaccounts/delete/id/<?= $line->id?>" title="удалить">
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
