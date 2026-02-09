<?php

namespace App\View\Components\Dynamic;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $bgColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $text = '',
        public string $variant = 'info' // info, success, error
    ) {
        $this->bgColor = match ($variant) {
            'success' => 'bg-green-600',
            'error' => 'bg-red-600',
            'info' => 'bg-sky-600',
            default => 'bg-gray-600',
        };
    }

    public function shouldRender(): bool
    {
        return ! empty($this->text);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dynamic.alert');
    }
}
