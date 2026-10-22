import { usePage } from '@inertiajs/react';
import { Cpu } from 'lucide-react';

export default function AppLogo() {
    const { name } = usePage<{ name?: string }>().props;

    return (
        <>
            <div className="flex size-7 shrink-0 items-center justify-center text-primary">
                <Cpu className="size-6 text-primary" />
            </div>
            <div className="ml-1.5 grid flex-1 text-left text-sm">
                <span className="mb-0.5 truncate leading-tight font-extrabold text-foreground tracking-tight">
                    {name || 'TechStore'}
                </span>
                <span className="truncate text-[10px] text-muted-foreground leading-none font-medium">
                    Hardware & Software
                </span>
            </div>
        </>
    );
}
