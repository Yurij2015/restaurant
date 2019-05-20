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
    
    
    
    class orderPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Заказы');
            $this->SetMenuLabel('Заказы');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`order`');
            $this->dataset->addFields(
                array(
                    new IntegerField('idorder', true, true, true),
                    new StringField('order_numb', true),
                    new DateField('date_order', true),
                    new IntegerField('client_id_client', true),
                    new IntegerField('menu_season_price'),
                    new IntegerField('price_menu'),
                    new IntegerField('service'),
                    new IntegerField('price_service')
                )
            );
            $this->dataset->AddLookupField('client_id_client', '`client`', new IntegerField('id_client'), new StringField('second_name', false, false, false, false, 'client_id_client_second_name', 'client_id_client_second_name_client'), 'client_id_client_second_name_client');
            $this->dataset->AddLookupField('price_menu', 'menu', new IntegerField('id_item'), new StringField('del_title', false, false, false, false, 'price_menu_del_title', 'price_menu_del_title_menu'), 'price_menu_del_title_menu');
            $this->dataset->AddLookupField('menu_season_price', 'price', new IntegerField('id_price'), new IntegerField('price_spring', false, false, false, false, 'menu_season_price_price_spring', 'menu_season_price_price_spring_price'), 'menu_season_price_price_spring_price');
            $this->dataset->AddLookupField('service', 'service', new IntegerField('id_service'), new StringField('service_title', false, false, false, false, 'service_service_title', 'service_service_title_service'), 'service_service_title_service');
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
                new FilterColumn($this->dataset, 'date_order', 'date_order', 'Дата заказа'),
                new FilterColumn($this->dataset, 'client_id_client', 'client_id_client_second_name', 'Клиент'),
                new FilterColumn($this->dataset, 'price_menu', 'price_menu_del_title', 'Стоимость меню'),
                new FilterColumn($this->dataset, 'menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда'),
                new FilterColumn($this->dataset, 'service', 'service_service_title', 'Услуги'),
                new FilterColumn($this->dataset, 'idorder', 'idorder', 'Код заказа'),
                new FilterColumn($this->dataset, 'order_numb', 'order_numb', 'Номер заказа'),
                new FilterColumn($this->dataset, 'price_service', 'price_service', 'Стоимость услуг')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['date_order'])
                ->addColumn($columns['client_id_client'])
                ->addColumn($columns['price_menu'])
                ->addColumn($columns['menu_season_price'])
                ->addColumn($columns['service'])
                ->addColumn($columns['order_numb'])
                ->addColumn($columns['price_service']);
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
            // View column for date_order field
            //
            $column = new DateTimeViewColumn('date_order', 'date_order', 'Дата заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for second_name field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_second_name', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('price_menu', 'price_menu_del_title', 'Стоимость меню', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for price_spring field
            //
            $column = new NumberViewColumn('menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_title field
            //
            $column = new TextViewColumn('service', 'service_service_title', 'Услуги', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for order_numb field
            //
            $column = new TextViewColumn('order_numb', 'order_numb', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for price_service field
            //
            $column = new NumberViewColumn('price_service', 'price_service', 'Стоимость услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for date_order field
            //
            $column = new DateTimeViewColumn('date_order', 'date_order', 'Дата заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for second_name field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_second_name', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('price_menu', 'price_menu_del_title', 'Стоимость меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for price_spring field
            //
            $column = new NumberViewColumn('menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_title field
            //
            $column = new TextViewColumn('service', 'service_service_title', 'Услуги', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for order_numb field
            //
            $column = new TextViewColumn('order_numb', 'order_numb', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for price_service field
            //
            $column = new NumberViewColumn('price_service', 'price_service', 'Стоимость услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for date_order field
            //
            $editor = new DateTimeEdit('date_order_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата заказа', 'date_order', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $lookupDataset->setOrderByField('second_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'second_name', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for price_menu field
            //
            $editor = new ComboBox('price_menu_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
                'Стоимость меню', 
                'price_menu', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for menu_season_price field
            //
            $editor = new ComboBox('menu_season_price_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`price`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_price', true, true, true),
                    new IntegerField('price_summer', true),
                    new IntegerField('price_fall', true),
                    new IntegerField('price_winter', true),
                    new IntegerField('price_spring', true),
                    new IntegerField('menu_id_item', true)
                )
            );
            $lookupDataset->setOrderByField('price_spring', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Наименование блюда', 
                'menu_season_price', 
                $editor, 
                $this->dataset, 'id_price', 'price_spring', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service field
            //
            $editor = new ComboBox('service_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_service', true, true, true),
                    new StringField('service_title'),
                    new StringField('servicedescription')
                )
            );
            $lookupDataset->setOrderByField('service_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Услуги', 
                'service', 
                $editor, 
                $this->dataset, 'id_service', 'service_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for order_numb field
            //
            $editor = new TextEdit('order_numb_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Номер заказа', 'order_numb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for price_service field
            //
            $editor = new TextEdit('price_service_edit');
            $editColumn = new CustomEditColumn('Стоимость услуг', 'price_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for date_order field
            //
            $editor = new DateTimeEdit('date_order_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата заказа', 'date_order', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $lookupDataset->setOrderByField('second_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'second_name', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for price_menu field
            //
            $editor = new ComboBox('price_menu_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
                'Стоимость меню', 
                'price_menu', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for menu_season_price field
            //
            $editor = new ComboBox('menu_season_price_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`price`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_price', true, true, true),
                    new IntegerField('price_summer', true),
                    new IntegerField('price_fall', true),
                    new IntegerField('price_winter', true),
                    new IntegerField('price_spring', true),
                    new IntegerField('menu_id_item', true)
                )
            );
            $lookupDataset->setOrderByField('price_spring', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Наименование блюда', 
                'menu_season_price', 
                $editor, 
                $this->dataset, 'id_price', 'price_spring', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service field
            //
            $editor = new ComboBox('service_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_service', true, true, true),
                    new StringField('service_title'),
                    new StringField('servicedescription')
                )
            );
            $lookupDataset->setOrderByField('service_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Услуги', 
                'service', 
                $editor, 
                $this->dataset, 'id_service', 'service_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for order_numb field
            //
            $editor = new TextEdit('order_numb_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Номер заказа', 'order_numb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for price_service field
            //
            $editor = new TextEdit('price_service_edit');
            $editColumn = new CustomEditColumn('Стоимость услуг', 'price_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for date_order field
            //
            $editor = new DateTimeEdit('date_order_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Дата заказа', 'date_order', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $lookupDataset->setOrderByField('second_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Клиент', 
                'client_id_client', 
                $editor, 
                $this->dataset, 'id_client', 'second_name', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for price_menu field
            //
            $editor = new ComboBox('price_menu_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
                'Стоимость меню', 
                'price_menu', 
                $editor, 
                $this->dataset, 'id_item', 'del_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for menu_season_price field
            //
            $editor = new ComboBox('menu_season_price_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`price`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_price', true, true, true),
                    new IntegerField('price_summer', true),
                    new IntegerField('price_fall', true),
                    new IntegerField('price_winter', true),
                    new IntegerField('price_spring', true),
                    new IntegerField('menu_id_item', true)
                )
            );
            $lookupDataset->setOrderByField('price_spring', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Наименование блюда', 
                'menu_season_price', 
                $editor, 
                $this->dataset, 'id_price', 'price_spring', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service field
            //
            $editor = new ComboBox('service_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id_service', true, true, true),
                    new StringField('service_title'),
                    new StringField('servicedescription')
                )
            );
            $lookupDataset->setOrderByField('service_title', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Услуги', 
                'service', 
                $editor, 
                $this->dataset, 'id_service', 'service_title', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for order_numb field
            //
            $editor = new TextEdit('order_numb_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Номер заказа', 'order_numb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for price_service field
            //
            $editor = new TextEdit('price_service_edit');
            $editColumn = new CustomEditColumn('Стоимость услуг', 'price_service', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // View column for date_order field
            //
            $column = new DateTimeViewColumn('date_order', 'date_order', 'Дата заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for second_name field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_second_name', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('price_menu', 'price_menu_del_title', 'Стоимость меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for price_spring field
            //
            $column = new NumberViewColumn('menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_title field
            //
            $column = new TextViewColumn('service', 'service_service_title', 'Услуги', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for order_numb field
            //
            $column = new TextViewColumn('order_numb', 'order_numb', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for price_service field
            //
            $column = new NumberViewColumn('price_service', 'price_service', 'Стоимость услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for date_order field
            //
            $column = new DateTimeViewColumn('date_order', 'date_order', 'Дата заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for second_name field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_second_name', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('price_menu', 'price_menu_del_title', 'Стоимость меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for price_spring field
            //
            $column = new NumberViewColumn('menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_title field
            //
            $column = new TextViewColumn('service', 'service_service_title', 'Услуги', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for order_numb field
            //
            $column = new TextViewColumn('order_numb', 'order_numb', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for price_service field
            //
            $column = new NumberViewColumn('price_service', 'price_service', 'Стоимость услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for date_order field
            //
            $column = new DateTimeViewColumn('date_order', 'date_order', 'Дата заказа', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for second_name field
            //
            $column = new TextViewColumn('client_id_client', 'client_id_client_second_name', 'Клиент', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for del_title field
            //
            $column = new TextViewColumn('price_menu', 'price_menu_del_title', 'Стоимость меню', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for price_spring field
            //
            $column = new NumberViewColumn('menu_season_price', 'menu_season_price_price_spring', 'Наименование блюда', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_title field
            //
            $column = new TextViewColumn('service', 'service_service_title', 'Услуги', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for order_numb field
            //
            $column = new TextViewColumn('order_numb', 'order_numb', 'Номер заказа', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for price_service field
            //
            $column = new NumberViewColumn('price_service', 'price_service', 'Стоимость услуг', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
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
        $Page = new orderPage("order", "order.php", GetCurrentUserPermissionSetForDataSource("order"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("order"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
