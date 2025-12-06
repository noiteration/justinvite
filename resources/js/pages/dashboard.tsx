import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

export default function Dashboard() {
    const [email, setEmail] = useState('');
    const [processing, setProcessing] = useState(false);
    const [error, setError] = useState('');
    const [success, setSuccess] = useState('');

    interface LaravelWindow extends Window {
        Laravel?: {
            csrfToken?: string;
        };
    }
    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setProcessing(true);
        setError('');
        setSuccess('');
        try {
            const response = await fetch('/api/invite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': (window as LaravelWindow).Laravel?.csrfToken || '',
                },
                body: JSON.stringify({ email }),
            });
            const data = await response.json();
            if (response.ok) {
                setSuccess(data.message);
                setEmail('');
            } else {
                setError(data.message || 'Error sending invitation.');
            }
        } catch {
            setError('Network error.');
        }
        setProcessing(false);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <h1 className='text-3xl font-semibold tracking-tight mb-4'>Invite Friends !</h1>
                <form onSubmit={handleSubmit} className="flex flex-col gap-6">
                    <div className="grid gap-3">
                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                tabIndex={2}
                                autoComplete="email"
                                name="email"
                                placeholder="email@example.com"
                                value={email}
                                onChange={e => setEmail(e.target.value)}
                            />
                        </div>
                        {error && <div className="text-red-500">{error}</div>}
                        {success && <div className="text-green-500">{success}</div>}
                        <Button
                            type="submit"
                            className="mt-2 w-full"
                            tabIndex={5}
                            data-test="send-invite-button"
                            disabled={processing}
                        >
                            {processing && <Spinner />}
                            Send Invite
                        </Button>

                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
