<?php

class ViewPersonalaccounts extends AbstractView {
        
     protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Лицевые счета</legend>
                <div class="row">
                    <!--номер счёта-->
                    <div class="form-group col-md-2">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">№ счёта</p>
                        <input type="text" name="numberaccount" class="form-control w100" value="<?= $this->item_form->numberaccount;?>">
                    </div>
                    <!--договор номер и дата-->
                    <div class="form-group col-md-5">
                        <p class="p-form">№ договора::дата</p>
                        <input type="text" name="contract" class="form-control w100" value="<?= $this->item_form->contract;?>">
                    </div>
                    <!--счётчик номер и дата поверки-->
                    <div class="form-group col-md-5">
                        <p class="p-form">№ счётчика::дата поверки</p>
                        <input type="text" name="meter" class="form-control w100" value="<?= $this->item_form->meter;?>">
                    </div>
                </div>
                <div class="row">
                    <!--фирма-->
                    <div class="form-group col-md-5"> 
                        <p class="p-form">фирма-владелец счёта</p>
                        <select name="company" class="form-control w100">
<?php   foreach ($this->item_form->company as $company): ?>
                            <option value="<?= $company['edrpou']?>"<?= $company['selected']?>>
                                <?= $company['ownershipabbr'].' '.$company['namecompany'].'::'.$company['edrpou']?>
                            </option>
<?      endforeach;?>
                            <option onclick="location.href='/company/main'">добавить</option>
                        </select>
                    </div>
                    <!--назначение счёта-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">назначение счёта</p>
                        <select name="accountpurpose" class="form-control w100">
                            <option value="электричество">1::электричество</option>
                            <option value="вода">2::вода</option>
                            <option value="газ">3::газ</option>
                        </select>
                    </div>
                    <!-- foreignKey справочника -->
                    <div class="col-md-1">
                        <input type="hidden" name="company_edrpou" value="<?= $this->item_form->company_edrpou;?>">
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
                <th align="center" width="15%">№ л/счёта</th>
                <th align="center" width="20%">№ договора::дата</th>
                <th align="center" width="20%">№ счётчика::дата поверки</th>
                <th align="center" width="15%">фирма</th>
                <th align="center" width="10%">назначение</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/bankaccounts/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->numberaccount;?></td>
                <td align="left"><?= $line->contract;?></td>
                <td align="left"><?= $line->meter?></td>
                <td align="left"><?= $line->company_n?></td>
                <td align="left"><?= $line->accountpurpose?></td>
                <td class="icon-edit">
                    <a href="/personalaccounts/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/personalaccounts/delete/id/<?= $line->id?>" title="удалить">
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
