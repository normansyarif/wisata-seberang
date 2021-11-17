<a href="{{ route('konten.edit', $q->id_konten) }}" class="btn btn-primary btn-sm">Edit</a>
<button onclick="
if(confirm('Anda yakin?')) {
    $(this).find('form').submit();
}
" class="btn btn-danger btn-sm">
    <form action="{{ route('konten.destroy', $q->id_konten) }}" method="post">
        @csrf
    </form>
    Hapus
</button>