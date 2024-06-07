<div id="userPaginationLinks" class="flex justify-center">
   {{ $users->appends(request()->query())->links() }}
</div>
