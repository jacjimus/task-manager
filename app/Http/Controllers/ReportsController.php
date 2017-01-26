<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Grids;
use Illuminate\Support\Facades\Config;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Illuminate\Support\Facades\Input;
use Html;

class ReportsController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }
    
    public function daily()
    {
        $query = (new \App\Task_Reports)
    ->newQuery()
    ->where('role', '=', 3);



# Instantiate & Configure Grid
$grid = new Grid(
            (new GridConfig)
                ->setDataProvider(
                    new EloquentDataProvider(\App\Task_Reports::query())
                )
                ->setName('Daily Reports')
                ->setPageSize(15)
                ->setColumns([
                    (new FieldConfig)
                        ->setName('assignee')
                        ->setLabel('ID')
                        ->setSortable(true)
                        //->setSorting(Grid::SORT_ASC)
                    ,
                    (new FieldConfig)
                        ->setName('fullname')
                        ->setLabel('Employee name')
                        ->setSortable(true)
                        //->setSorting(Grid::SORT_ASC)
                    ,
                    (new FieldConfig)
                        ->setName('status_assigned_tasks')
                        ->setLabel('Tasks Assigned')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            //$icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                                //. $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        
                    ,
                    (new FieldConfig)
                        ->setName('status_completed_tasks')
                        ->setLabel('Tasks Completed')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                           // $icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                               // . $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        
                    ,
                    (new FieldConfig)
                        ->setName('status_ongoing_task')
                        ->setLabel('Tasks Pending')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            //$icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                                //. $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        
                    ,
                    (new FieldConfig)
                        ->setName('status_due_tasks')
                        ->setLabel('Tasks Due')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            //$icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                                //. $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        
                    
                ])
                ->setComponents([
                    (new THead)
                        ->setComponents([
                            (new ColumnHeadersRow),
                            (new FiltersRow)
                                ->addComponents([
                                    (new RenderFunc(function () {
                                        return HTML::style('daterangepicker/daterangepicker-bs3.css')
                                        . HTML::script('moment/moment-with-locales.js')
                                        . HTML::script('daterangepicker/daterangepicker.js')
                                        . "<style>
                                                .daterangepicker td.available.active,
                                                .daterangepicker li.active,
                                                .daterangepicker li:hover {
                                                    color:black !important;
                                                    font-weight: bold;
                                                }
                                           </style>";
                                    }))
                                        ->setRenderSection('filters_row_column_assigned'),
                                    ])
                            ,
                            (new OneCellRow)
                                ->setRenderSection(RenderableRegistry::SECTION_END)
                                ->setComponents([
                                    new RecordsPerPage,
                                    new ColumnsHider,
                                    (new CsvExport)
                                        ->setFileName('tasks_daily_report' . date('Y-m-d'))
                                    ,
                                    new ExcelExport(),
                                    (new HtmlTag)
                                        ->setContent('<span class="glyphicon glyphicon-refresh"></span> Filter')
                                        ->setTagName('button')
                                        ->setRenderSection(RenderableRegistry::SECTION_END)
                                        ->setAttributes([
                                            'class' => 'btn btn-success btn-sm'
                                        ])
                                ])
                        ])
                    ,
                    (new TFoot)
                        ->setComponents([
                            (new TotalsRow(['posts_count', 'comments_count'])),
                            (new TotalsRow(['posts_count', 'comments_count']))
                                ->setFieldOperations([
                                    'posts_count' => TotalsRow::OPERATION_AVG,
                                    'comments_count' => TotalsRow::OPERATION_AVG,
                                ])
                            ,
                            (new OneCellRow)
                                ->setComponents([
                                    new Pager,
                                    (new HtmlTag)
                                        ->setAttributes(['class' => 'pull-right'])
                                        ->addComponent(new ShowingRecords)
                                    ,
                                ])
                        ])
                    ,
                ])
        );
        $grid = $grid->render();
        return view('grids.daily', compact('grid'));
    }
    public function weekly()
    {
        $query = (new \App\Tasks)
    ->newQuery()
    ->with('users');
    //->where('role', '=', 3);



# Instantiate & Configure Grid
$grid = new Grid(
            (new GridConfig)
                ->setDataProvider(
                    new EloquentDataProvider(User::query())
                )
                ->setName('Daily Reports')
                ->setPageSize(15)
                ->setColumns([
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('ID')
                        ->setSortable(true)
                        ->setSorting(Grid::SORT_ASC)
                    ,
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->setCallback(function ($val) {
                            return "<span class='glyphicon glyphicon-user'></span>{$val}";
                        })
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('email')
                        ->setLabel('Email')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            $icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                                . $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('phone_number')
                        ->setLabel('Phone')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('country')
                        ->setLabel('Country')
                        ->setSortable(true)
                    ,
                    (new FieldConfig)
                        ->setName('company')
                        ->setLabel('Company')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('birthday')
                        ->setLabel('Birthday')
                        ->setSortable(true)
                    ,
                    (new FieldConfig)
                        ->setName('posts_count')
                        ->setLabel('Posts')
                        ->setSortable(true)
                    ,
                    (new FieldConfig)
                        ->setName('comments_count')
                        ->setLabel('Comments')
                        ->setSortable(true)
                    ,
                ])
                ->setComponents([
                    (new THead)
                        ->setComponents([
                            (new ColumnHeadersRow),
                            (new FiltersRow)
                                ->addComponents([
                                    (new RenderFunc(function () {
                                        return HTML::style('js/daterangepicker/daterangepicker-bs3.css')
                                        . HTML::script('js/moment/moment-with-locales.js')
                                        . HTML::script('js/daterangepicker/daterangepicker.js')
                                        . "<style>
                                                .daterangepicker td.available.active,
                                                .daterangepicker li.active,
                                                .daterangepicker li:hover {
                                                    color:black !important;
                                                    font-weight: bold;
                                                }
                                           </style>";
                                    }))
                                        ->setRenderSection('filters_row_column_birthday'),
                                    (new DateRangePicker)
                                        ->setName('created_at')
                                        ->setRenderSection('filters_row_column_birthday')
                                        ->setDefaultValue(['1990-01-01', date('Y-m-d')])
                                ])
                            ,
                            (new OneCellRow)
                                ->setRenderSection(RenderableRegistry::SECTION_END)
                                ->setComponents([
                                    new RecordsPerPage,
                                    new ColumnsHider,
                                    (new CsvExport)
                                        ->setFileName('my_report' . date('Y-m-d'))
                                    ,
                                    new ExcelExport(),
                                    (new HtmlTag)
                                        ->setContent('<span class="glyphicon glyphicon-refresh"></span> Filter')
                                        ->setTagName('button')
                                        ->setRenderSection(RenderableRegistry::SECTION_END)
                                        ->setAttributes([
                                            'class' => 'btn btn-success btn-sm'
                                        ])
                                ])
                        ])
                    ,
                    (new TFoot)
                        ->setComponents([
                            (new TotalsRow(['posts_count', 'comments_count'])),
                            (new TotalsRow(['posts_count', 'comments_count']))
                                ->setFieldOperations([
                                    'posts_count' => TotalsRow::OPERATION_AVG,
                                    'comments_count' => TotalsRow::OPERATION_AVG,
                                ])
                            ,
                            (new OneCellRow)
                                ->setComponents([
                                    new Pager,
                                    (new HtmlTag)
                                        ->setAttributes(['class' => 'pull-right'])
                                        ->addComponent(new ShowingRecords)
                                    ,
                                ])
                        ])
                    ,
                ])
        );
        $grid = $grid->render();
        return view('grids.weekly', compact('grid'));
    }
}
