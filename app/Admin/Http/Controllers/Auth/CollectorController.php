<?php

namespace App\Admin\Http\Controllers\Auth;

use Admin\Auth\Actions\CreateCollectorAction;
use Admin\Auth\Actions\UpdateCollectorAction;
use Admin\Auth\DTOs\UpdateCollectorDTO;
use Admin\Auth\ViewModels\CollectorIndexViewModel;
use Admin\Auth\ViewModels\CollectorUpdateViewModel;
use App\Admin\Http\Requests\Auth\CreateCollectorRequest;
use App\Admin\Http\Requests\Auth\FilterCollectorRequest;
use App\Admin\Http\Requests\Auth\UpdateCollectorRequest;
use App\Http\Controllers\Controller;
use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\Models\Collector;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\MassDeletingRequest;
use Support\ViewModels\AsyncSelectByQueryViewModel;


class CollectorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Collector::class, 'collector');
    }

    public function index(FilterCollectorRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.collector.index', new CollectorIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.collector.create', new CollectorUpdateViewModel());
    }

    public function store(CreateCollectorRequest $request, CreateCollectorAction $action): RedirectResponse
    {
        $action(NewCollectorDTO::fromRequest($request));

        flash()->info(__('user.collector.created'));

        return to_route('admin.collectors.index');
    }

    public function show(Collector $collector)
    {
        return view('admin.user.collector.show', compact(['collector']));
    }

    public function edit(Collector $collector): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.collector.edit', new CollectorUpdateViewModel($collector));
    }

    public function update(UpdateCollectorRequest $request, Collector $collector, UpdateCollectorAction $action): RedirectResponse
    {
        $action(UpdateCollectorDTO::fromRequest($request), $collector);

        flash()->info(__('user.collector.updated'));

        return to_route('admin.collectors.index');
    }

    public function destroy(Collector $collector): RedirectResponse
    {
        $collector->delete();

        flash()->info(__('user.collector.deleted'));

        return to_route('admin.collectors.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Collector::class,
                $request->input('ids')
            )
        );

        flash()->info(__('user.collector.mass_deleted'));

        return to_route('admin.collectors.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Collector::class,
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('user.collector.mass_force_deleted'));

        return to_route('admin.collectors.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        Gate::authorize('getForSelect', Collector::class);

        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            Collector::class,
            trans_choice('user.collector.choose', 1)
        );
    }
}
