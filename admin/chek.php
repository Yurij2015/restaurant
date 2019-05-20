<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class chekPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Счета');
            $this->SetMenuLabel('Счета');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`chek`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id_chek', true, true, true),
                    new IntegerField('summa_chek'),
                    new DateField('date_chek'),
                    new IntegerField('summa_nomer'),
                    new IntegerField('summa_service'),
                    new IntegerField('client_id_client', true),
                    new IntegerField('menu_id_item', true),
                    new IntegerField('order_idorder', true)
                )
            );
            $this->dataset->AddLookupField('client_id_client', '`client`', new IntegerField('id_client'), new StringField('surname', false, false, false, false, 'client_id_client_surname', 'client_id_client_surname_client'), 'client_id_client_surname_client');
            $this->dataset->AddLookupField('menu_id_item', 'menu', new IntegerField('id_item'), new StringField('del_title', false, false, false, false, 'menu_id_item_del_title', 'menu_id_item_del_title_menu'), 'menu_id_item_del_title_menu');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id_chek', 'id_chek', 'Код чека'),
                new FilterColumn($this->dataset, 'summa_chek', 'summa_chek', 'Общая сумма'),
                new FilterColumn($this->dataset, 'date_chek', 'date_chek', 'Дата'),
                new FilterColumn($this->dataset, 'summa_nomer', 'summa_nomer', 'Сумма меню'),
                new FilterColumn($this->dataset, 'summa_service', 'summa_service', 'Сумма услуг'),
                new FilterColumn($this->dataset, 'client_id_client', 'client_id_client_surname', 'Клиент'),
                new FilterColumn($this->dataset, 'menu_id_item', 'menu_id_item_del_title', 'Меню'),
                new FilterColumn($this->dataset, 'order_idorder', 'order_idorder', 'Номер заказа')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['summa_chek'])
                ->addColumn($columns['date_chek'])
                ->addColumn($columns['summa_nomer'])
                ->addColumn($columns['summa_service'])
                ->addColumn($columns['client_id_client'])
                ->addColumn($columns['menu_id_item'])
                ->addColumn($columns['order_idorder']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for summa_chek field
            //
            $column = new TextViewColumn('summa_chek', 'summa_chek', 'Общая сумма', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_chek field
            //
            $column = new DateTimeViewColumn('date_chek', 'date_chek', 'Дата', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for summa_nomer field
            //
            $column = new TextViewColumn('summa_nomer', 'summa_nomer', 'Сумма меню', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for summa_service field
            //
            $column = new TextViewColumn('summa_service', 'summa_service', 'Сумма услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for surname field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_surname', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('menu_id_item', 'menu_id_item_del_title', 'Меню', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for summa_chek field
            //
            $column = new TextViewColumn('summa_chek', 'summa_chek', 'Общая сумма', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_chek field
            //
            $column = new DateTimeViewColumn('date_chek', 'date_chek', 'Дата', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for summa_nomer field
            //
            $column = new TextViewColumn('summa_nomer', 'summa_nomer', 'Сумма меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for summa_service field
            //
            $column = new TextViewColumn('summa_service', 'summa_service', 'Сумма услуг', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for surname field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_surname', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('menu_id_item', 'menu_id_item_del_title', 'Меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for order_idorder field
            //
            $column = new NumberViewColumn('order_idorder', 'order_idorder', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for summa_chek field
            //
            $editor = new TextEdit('summa_chek_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Общая сумма', 'summa_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_chek field
            //
            $editor = new DateTimeEdit('date_chek_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата', 'date_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for summa_nomer field
            //
            $editor = new TextEdit('summa_nomer_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма меню', 'summa_nomer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for summa_service field
            //
            $editor = new TextEdit('summa_service_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма услуг', 'summa_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for client_id_client field
            //
            $editor = new ComboBox('client_id_client_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_client', true, true, true),
                    new StringField('surname', true),
                    new StringField('firstname', true),
                    new StringField('second_name', true),
                    new DateField('date', true),
                    new StringField('pasport', true),
                    new StringField('email', true),
                    new StringField('telefon', true)
                )
            );
            $lookupDataset->setOrderByField('surname', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'surname', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for menu_id_item field
            //
            $editor = new ComboBox('menu_id_item_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`menu`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_item', true, true, true),
                    new StringField('del_title'),
                    new StringField('class_menu'),
                    new IntegerField('number_peace_menu'),
                    new IntegerField('restorans_id_restoran', true)
                )
            );
            $lookupDataset->setOrderByField('del_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Меню', 
                'menu_id_item', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for order_idorder field
            //
            $editor = new ComboBox('order_idorder_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Номер заказа', 'order_idorder', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for summa_chek field
            //
            $editor = new TextEdit('summa_chek_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Общая сумма', 'summa_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for date_chek field
            //
            $editor = new DateTimeEdit('date_chek_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата', 'date_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for summa_nomer field
            //
            $editor = new TextEdit('summa_nomer_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма меню', 'summa_nomer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for summa_service field
            //
            $editor = new TextEdit('summa_service_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма услуг', 'summa_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for client_id_client field
            //
            $editor = new ComboBox('client_id_client_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_client', true, true, true),
                    new StringField('surname', true),
                    new StringField('firstname', true),
                    new StringField('second_name', true),
                    new DateField('date', true),
                    new StringField('pasport', true),
                    new StringField('email', true),
                    new StringField('telefon', true)
                )
            );
            $lookupDataset->setOrderByField('surname', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'surname', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for menu_id_item field
            //
            $editor = new ComboBox('menu_id_item_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`menu`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_item', true, true, true),
                    new StringField('del_title'),
                    new StringField('class_menu'),
                    new IntegerField('number_peace_menu'),
                    new IntegerField('restorans_id_restoran', true)
                )
            );
            $lookupDataset->setOrderByField('del_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Меню', 
                'menu_id_item', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for order_idorder field
            //
            $editor = new ComboBox('order_idorder_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Номер заказа', 'order_idorder', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for summa_chek field
            //
            $editor = new TextEdit('summa_chek_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Общая сумма', 'summa_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_chek field
            //
            $editor = new DateTimeEdit('date_chek_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата', 'date_chek', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for summa_nomer field
            //
            $editor = new TextEdit('summa_nomer_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма меню', 'summa_nomer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for summa_service field
            //
            $editor = new TextEdit('summa_service_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Сумма услуг', 'summa_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for client_id_client field
            //
            $editor = new ComboBox('client_id_client_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_client', true, true, true),
                    new StringField('surname', true),
                    new StringField('firstname', true),
                    new StringField('second_name', true),
                    new DateField('date', true),
                    new StringField('pasport', true),
                    new StringField('email', true),
                    new StringField('telefon', true)
                )
            );
            $lookupDataset->setOrderByField('surname', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'surname', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for menu_id_item field
            //
            $editor = new ComboBox('menu_id_item_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`menu`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_item', true, true, true),
                    new StringField('del_title'),
                    new StringField('class_menu'),
                    new IntegerField('number_peace_menu'),
                    new IntegerField('restorans_id_restoran', true)
                )
            );
            $lookupDataset->setOrderByField('del_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Меню', 
                'menu_id_item', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for order_idorder field
            //
            $editor = new ComboBox('order_idorder_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Номер заказа', 'order_idorder', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for summa_chek field
            //
            $column = new TextViewColumn('summa_chek', 'summa_chek', 'Общая сумма', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_chek field
            //
            $column = new DateTimeViewColumn('date_chek', 'date_chek', 'Дата', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for summa_nomer field
            //
            $column = new TextViewColumn('summa_nomer', 'summa_nomer', 'Сумма меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for summa_service field
            //
            $column = new TextViewColumn('summa_service', 'summa_service', 'Сумма услуг', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for surname field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_surname', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('menu_id_item', 'menu_id_item_del_title', 'Меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for order_idorder field
            //
            $column = new NumberViewColumn('order_idorder', 'order_idorder', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for summa_chek field
            //
            $column = new TextViewColumn('summa_chek', 'summa_chek', 'Общая сумма', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_chek field
            //
            $column = new DateTimeViewColumn('date_chek', 'date_chek', 'Дата', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for summa_nomer field
            //
            $column = new TextViewColumn('summa_nomer', 'summa_nomer', 'Сумма меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for summa_service field
            //
            $column = new TextViewColumn('summa_service', 'summa_service', 'Сумма услуг', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for surname field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_surname', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('menu_id_item', 'menu_id_item_del_title', 'Меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for order_idorder field
            //
            $column = new NumberViewColumn('order_idorder', 'order_idorder', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for summa_chek field
            //
            $column = new TextViewColumn('summa_chek', 'summa_chek', 'Общая сумма', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for date_chek field
            //
            $column = new DateTimeViewColumn('date_chek', 'date_chek', 'Дата', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for summa_nomer field
            //
            $column = new TextViewColumn('summa_nomer', 'summa_nomer', 'Сумма меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for summa_service field
            //
            $column = new TextViewColumn('summa_service', 'summa_service', 'Сумма услуг', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for surname field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_surname', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('menu_id_item', 'menu_id_item_del_title', 'Меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for order_idorder field
            //
            $column = new NumberViewColumn('order_idorder', 'order_idorder', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->setAllowSortingByDialog(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setAllowAddMultipleRecords(false);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(false);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array());
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new chekPage("chek", "chek.php", GetCurrentUserPermissionSetForDataSource("chek"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("chek"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
