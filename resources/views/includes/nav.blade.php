<div class="panel panel-default">
    <div class="panel-heading">Заказы</div>

    <div class="panel-body">
        <ul style="list-style: none;">
            <li>
                <a href="/home">Мои заказы <span class="badge countOrder">{{ ($countOrder) ? $countOrder : '' }}</span></a>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Категории</div>

    <div class="panel-body">
        <ul style="list-style: none;">
            <li>
                <a href="{{ route('category.show') }}">Показать</a>
            </li>
            <li>
                <a href="{{ route('category.create') }}">Создать</a>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Товар</div>

    <div class="panel-body">
        <ul style="list-style: none;">
            <li>
                <a href="{{ route('item.show') }}">Показать</a>
            </li>
            <li>
                <a href="{{ route('item.create') }}">Создать</a>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Настройки</div>

    <div class="panel-body">
        <ul style="list-style: none;">
            <li>
                <a href="{{ route('setting.home') }}">Главная</a>
            </li>
        </ul>
    </div>
</div>