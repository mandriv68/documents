<?php

class ViewDocreport extends AbstractView {
    
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
<?php
        if (!$_SESSION['company']) {
            $this->getCompanyName();
?>
        </div>
<?php
        }
        else {
?>
            <div class="col-md-8 orange">
                <h4><?= $_SESSION['company_name'];?> :: отчёты по электричеству</h4>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="btn-btn btn-red">
                    <a href="#insertDocreport" data-toggle="modal">
                        <i class="fa fa-plus"></i>&nbsp новый документ
                    </a>
                </div>
                <?= $this->getDocument();?>
            </div>
        </div>
        <div class="row" style="padding: 0 15px;">
            <div class="col-md-12 divider"></div>
        </div>
        <div class="row top15">
            <div class="col-md-12">
<?      $this->getTable();
        if ($_SESSION['result']):?>
            <p><?= $_SESSION['result']?></p>
<?          unset($_SESSION['result']);
        endif;?>
            </div>
        </div>

<?      }?>
    </div>
<?php
    }
    
    protected function getCompanyName() {
?>
            <div class="col-md-8 bottom15">
                <form role="form" class="form-horizontal" method="post">
                    <input type="hidden" name="form" value="company">
                    <span class="col-md-9">    
                        <select name="company" class="form-control input-sm">
                            <option class="orange" value="0">выберите фирму для продолжения работы</option>
<?php       foreach ($this->item_form as $company):
            if ($company->flag):
?>                    
                            <option value="<?= $company->edrpou?>">
                                <?= $company->ownershipabbr.' '.$company->namecompany.'::'.$company->edrpou?>
                            </option>

<?php           endif;    
        endforeach;
?>
                        </select>
                    </span>
                    <span class="col-md-3">
                        <button type="submit" class="btn btn-red btn-sm">Выбрать</button>
                    </span>
                </form>
            </div>
<?php
    }
    
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
            <tr bgcolor="grey">
                <th align="center" width="6%">№ п/с</th>
                <th align="center" width="15%">дата</th>
                <th align="center" width="15%">№ л/счёта</th>
                <th align="center" width="20%">пред.показания</th>
                <th align="center" width="20%">посл.показания</th>
                <th align="center" width="10%">потребление</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?php   $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/docreport/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->dt;?></td>
                <td align="left"><?= $line->num_pers_account;?></td>
                <td align="left"><?= $line->meter_reading_before;?></td>
                <td align="left"><?= $line->meter_reading_after;?></td>
                <td align="left"><?= $line->excpense;?></td>
                <td class="icon-edit">
                    <a href="/docreport/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/docreport/delete/id/<?= $line->id?>" title="удалить">
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>
            </tr>
<?          $count++;
        endforeach;?>   
        </table>
<?php   }

   protected function getDocument() {
?>
<!-- Modal -->
<div class="modal fade" id="insertDocreport" tabindex="-1" role="dialog" aria-labelledby="insertDocreportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Новый документ</h5>
            </div>
            <div class="modal-body">
                <?= $this->getForm();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<?php
    }
    
    protected function getForm() {
?>   
        <form name="document"role="form" class="form-inline" method="post">
            <fieldset>
                <div class="row">
                    <!--дата-->
                    <div class="form-group col-md-4">
                        <input type="hidden" name="form" value="document">
                        <p class="p-form">дата</p>
                        <div class="input-group date">
                            <input type="text" id="dtp" class="form-control">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
<!--                        <div class="input-group date" id="datedoc">
                            <input type="text" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>-->
                    </div>
                    <!--предыдущие показания-->
                    <div class="form-group col-md-4"> 
                        <p class="p-form">предыдущие показания<p>
                        <input type="text" name="meter_reading_before" class="form-control w100" value="">
                    </div>
                    <!--последние показания-->
                    <div class="form-group col-md-4"> 
                        <p class="p-form">последние показания<p>
                        <input type="text" name="meter_reading_after" class="form-control w100" value="">
                    </div>
<!--                    <div class="col-md-2">
                        <p style="visibility: hidden;" class="p-form">bottom</p>
                        <button type="submit" class="btn btn-red">запомнить</button>
                    </div>-->
                </div>
            </fieldset>
        </form>
<?php
    }
        
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
