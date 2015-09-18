<?php

class ViewUsers extends AbstractView {
        
     protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование справочник Пользователи</legend>
                <div class="row">
                    <!--логин-->
                    <div class="form-group col-md-6">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">логин</p>
                        <input type="text" name="login" class="form-control w100" value="<?= $this->item_form->login;?>">
                    </div>
                    <!--привилегия-->
                    <div class="form-group col-md-4">
                        <p class="p-form">привилегия</p>
                        <input type="text" name="privileg" class="form-control w100" value="<?= $this->item_form->privileg;?>">
                    </div>
                    <!--количество итераций-->
                    <div class="form-group col-md-2">
                        <p class="p-form">к-во итераций</p>
                        <input type="text" name="count_it" class="form-control w100" value="<?= $this->item_form->count_it;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <p class="p-form">соль</p>
                        <input type="text" name="salt" class="form-control w100" value="<?= ($this->item_form->salt ? $this->item_form->salt : 'FamfY5659GamLeduop85YYrcK935DD');?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <p class="p-form">пароль</p>
                        <input type="text" name="salt" class="form-control w100" value="<?= $this->item_form->pass;?>">
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
                <th align="center" width="40%">логин</th>
                <th align="center" width="40%">привилегия</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/users/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->login;?></td>
                <td align="left"><?= $line->privileg;?></td>
                <td class="icon-edit">
                    <a href="/users/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/users/delete/id/<?= $line->id?>" title="удалить">
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
