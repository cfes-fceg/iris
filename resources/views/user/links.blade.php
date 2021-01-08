<x-user-layout :title="__('Resources')">
    <div class="flex flex-col md:flex-row">
        <div class="m-2 p-3 bg-white rounded shadow flex-grow ">
            <div class="text-xl">{{__('Conference Resources')}}</div>
            <hr class="my-2"/>
            <div class="text-sm">
                <a target="_blank"
                   class="block text-blue-500 hover:underline my-1"
                   href="{{ __('https://cfes.ca/irc') }}">
                    {{ __('Incident Report Form') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/drive/u/0/folders/1ytF2XlpJvFQZ46ybwaQybILLfiiltVEz">
                    {{ __('Conference Documents (Google Drive)') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://docs.google.com/spreadsheets/d/17G9Q3bCMTngVjQg6aNIVV6cSa2EJ1QTu9fpGUmhfRYk/edit?usp=sharing">
                    {{ __('Schedule') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/file/d/1M2G0aRmil6FCuna0pXMxvQqJ9OBWveLv/view">
                    {{ __('Delegate Package') }}
                </a>
            </div>
        </div>
        <div class="m-2 p-3 bg-white rounded shadow flex-grow">
            <div class="text-xl">{{__('VPX Resources')}}</div>
            <hr class="my-2"/>
            <div class="text-sm">
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/drive/folders/1z0u4shgeA4UfgcyNDy9f1uFsHdtqLeyC?usp=sharing">
                    {{ __('VPX Stream Documents (Google Drive)') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/drive/folders/1gpZ59rhOvMyWhVMwzwz4TzUlvDkuFNGE">
                    {{ __('Past GA Minutes') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/open?id=1ZhjQMvoyW7sKQofN6PjTK4u9Ro6qWAC8G3OMDHlhNoU">
                    {{ __('Motion Tracking') }}
                </a>
                <a class="block text-blue-500 hover:underline my-1"
                   target="_blank"
                   href="https://drive.google.com/open?id=1mkWy2kubO4bMrVNMeeHICdhHGqJK_PJ2">
                    {{ __('Motion Template') }}
                </a>
            </div>
        </div>
    </div>
</x-user-layout>


