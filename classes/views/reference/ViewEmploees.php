<?php

class ViewEmploees extends AbstractView {
            
        protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Сотрудники</legend>
                <div class="row">
                    <!--Имя, отчество-->
                    <div class="form-group col-md-7">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">имя и отчество</p>
                        <input type="text" name="firstname" class="form-control w100" value="<?= $this->item_form->firstname;?>">
                    </div>
                    <!--фамилия-->
                    <div class="form-group col-md-5"> 
                        <p class="p-form">фамилия<p>
                        <input type="text" name="lastname" class="form-control w100" value='<?= $this->item_form->lastname;?>'>
                    </div>
                </div>
                <div class="row">
                    <!--паспорт-->
                    <div class="form-group col-md-12"> 
                        <p class="p-form">
                            паспорт<span style="font-size:0.8em;">(серия::номер::кем выдан::когда(дата)</span>
                        </p>
                        <input type="text" name="pasport" class="form-control w100" value="<?= $this->item_form->pasport;?>">
                    </div>
                </div>
                <div class="row">
                    <!--индивидуальный налоговый номер-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">
                            ИНН<span style="font-size:0.8em;">(инд. налоговый номер)</span>
                        </p>
                        <input type="text" name="itnl" class="form-control w100" value="<?= $this->item_form->itnl;?>">
                    </div>
                    <!--фирма-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">фирма</p>
                        <select name="company" class="form-control w100">
<?php   foreach ($this->item_form->company as $company): ?>
                            <option value="<?= $company['edrpou']?>"<?= $company['selected']?>>
                                <?= $company['edrpou'].'::'.$company['ownershipabbr'].' '.$company['namecompany']?>
                            </option>
<?      endforeach;?>
                            <option onclick="location.href='/company/main'">добавить</option>
                        </select>
                    </div>
                    <!--должность-->
                    <div class="form-group col-md-3"> 
                        <p class="p-form">должность</p>
                        <select name="post" class="form-control w100">
<?php   foreach ($this->item_form->post as $post): ?>
                            <option value="<?= $post['id']?>"<?= $post['selected']?>>
                                <?= $post['postname']?>
                            </option>
<?      endforeach;?>
                            <option onclick="location.href='/posts/main'">добавить</option>
                        </select>
                    </div>
                    <!-- foreignKey справочника -->
                    <div class="col-md-1">
                        <input type="hidden" name="company_edrpou" value="<?= $this->item_form->company_edrpou;?>">
                        <input type="hidden" name="posts_id" value="<?= $this->item_form->posts_id;?>">
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
                <th align="center" width="40%">ФИО</th>
                <th align="center" width="40%">фирма::должность</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/emploees/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->fullname;?></td>
                <td align="left"><?= $line->company_and_post;?></td>
                <td class="icon-edit">
                    <a href="/emploees/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/emploees/delete/id/<?= $line->id?>" title="удалить">
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
