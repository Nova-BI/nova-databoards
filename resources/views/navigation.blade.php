@if (config('nova-databoards.showToolMenu') === true)


<router-link tag="h3" :to="{name: 'nova-databoards'}"
             class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path fill="var(--sidebar-icon)"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
        />
    </svg>
    <span class="sidebar-label">
        {{ __('Databoards') }}
    </span>
</router-link>



<ul class="list-reset mb-8">
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                name: 'index',
                params: {
                resourceName: '{{ \NovaBI\NovaDataboards\Nova\Databoard::uriKey() }}',
                }
                }" class="text-white ml-8 no-underline dim">
            {{ __('All Databoards') }}
        </router-link>
    </li>
</ul>


<h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide">{{ __('Configuration') }}</h4>
<ul class="list-reset mb-8">
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                name: 'index',
                params: {
                resourceName: '{{ \NovaBI\NovaDataboards\Nova\DataboardConfiguration::uriKey() }}',
                }
                }" class="text-white ml-8 no-underline dim">
            {{ __('Boards') }}
        </router-link>
    </li>
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                name: 'index',
                params: {
                resourceName: '{{ \NovaBI\NovaDataboards\Nova\Datawidget::uriKey() }}',
                }
                }" class="text-white ml-8 no-underline dim">
            {{ __('Widgets') }}
        </router-link>
    </li>
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                name: 'index',
                params: {
                resourceName: '{{ \NovaBI\NovaDataboards\Nova\Datafilter::uriKey() }}',
                }
                }" class="text-white ml-8 no-underline dim">
            {{ __('Filter') }}
        </router-link>
    </li>
    {{--
                <a href="{{ url(\Laravel\Nova\Nova::path()  . '/resources/' . \NovaBI\NovaDataboards\Nova\Databoard::uriKey() , ['resourceId' => 1]) }}">Databoard 1</a>
    --}}


    </li>

</ul>
@endif
