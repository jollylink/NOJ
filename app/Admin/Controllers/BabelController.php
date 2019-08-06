<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Babel\ExtensionModel;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Redirect;

class BabelController extends Controller
{
    /**
     * Show the MarketSpace Page.
     *
     * @return Response
     */
    public function index(Content $content)
    {
        return redirect()->route('admin.babel.installed');
    }

    /**
     * Show the Installed Page.
     *
     * @return Response
     */
    public function installed(Content $content)
    {
        return $content
            ->header('Installed Babel Extension')
            ->description('Manage your installed Babel Extension')
            ->row(function(Row $row) {
                $row->column(12, function(Column $column) {
                    $column->append(Self::installedView());
                });
            });
    }

    /**
     * Show the MarketSpace Page.
     *
     * @return Response
     */
    public function marketspace(Content $content)
    {
        return $content
            ->header('Babel Marketspace')
            ->description('Find extensions from marketspace')
            ->row(function(Row $row) {
                $row->column(12, function(Column $column) {
                    $column->append(Self::marketspaceView());
                });
            });
    }

    private static function installedView()
    {
        $installedExtensionList=ExtensionModel::localList();

        return view('admin::babel.installed', [
            'installedExtensionList'=>$installedExtensionList
        ]);
    }

    private static function marketspaceView()
    {
        $extensionList=ExtensionModel::list();

        if(empty($extensionList)){
            return redirect('/admin');
        }

        return view('admin::babel.marketspace', [
            'extensionList'=>$extensionList
        ]);
    }
}