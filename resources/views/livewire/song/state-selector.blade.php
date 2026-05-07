<select wire:change="updateState($event.target.value)">
    <option value="0" {{ ($state ?? 0) === 0 ? 'selected' : '' }}>未設定</option>
    <option value="1" {{ ($state ?? 0) === 1 ? 'selected' : '' }}>気になる</option>
    <option value="2" {{ ($state ?? 0) === 2 ? 'selected' : '' }}>練習中</option>
    <option value="3" {{ ($state ?? 0) === 3 ? 'selected' : '' }}>習得済み</option>
</select>
