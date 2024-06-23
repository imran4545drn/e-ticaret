<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Sipariş Detayları</h1>

    <!-- Grid -->
    <div class="grid gap-4 mt-5 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="flex p-4 md:p-5 gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 text-gray-600 size-5 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-gray-500 uppercase">
                            Müşteri
                        </p>
                    </div>
                    <div class="flex items-center mt-1 gap-x-2">
                        <div>{{$address->full_name}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="flex p-4 md:p-5 gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 text-gray-600 size-5 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-gray-500 uppercase">
                            Sipariş Tarihi
                        </p>
                    </div>
                    <div class="flex items-center mt-1 gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{$order_items[0]->created_at->format('d-m-y')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="flex p-4 md:p-5 gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 text-gray-600 size-5 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-gray-500 uppercase">
                            Sipariş Durumu
                        </p>
                    </div>
                    <div class="flex items-center mt-1 gap-x-2">
                        @php
                        $status = '';
                        if ($Order->status == 'new') {
                            $status = '<span class="bg-blue-500 px-3 py-1 text-white rounded shadow">new</span>';
                        }
                        elseif ($Order->status == 'processing') {
                            $status = '<span class="bg-yellow-500 px-3 py-1 text-white rounded shadow">processing</span>';
                        }
                        elseif ($Order->status == 'shipped') {
                            $status = '<span class="bg-green-500 px-3 py-1 text-white rounded shadow">shipped</span>';
                        }
                        elseif ($Order->status == 'delivered') {
                            $status = '<span class="bg-green-500 px-3 py-1 text-white rounded shadow">delivered</span>';
                        }
                        elseif ($Order->status == 'cancelled') {
                            $status = '<span class="bg-red-500 px-3 py-1 text-white rounded shadow">cancelled</span>';
                        }
                    @endphp

                    {!! $status !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="flex p-4 md:p-5 gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 text-gray-600 size-5 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-gray-500 uppercase">
                            Ödeme Durumu
                        </p>
                    </div>
                    <div class="flex items-center mt-1 gap-x-2">
                        @php
                        $payment_status = '';

                                if ($Order->payment_status == 'pending') {
                                    $payment_status = '<span class="bg-blue-500 px-3 py-1 text-white rounded shadow">pending</span>';
                                }
                                if ($Order->payment_status == 'paid') {
                                    $payment_status = '<span class="bg-green-600 px-3 py-1 text-white rounded shadow">paid</span>';
                                }
                                if ($Order->payment_status == 'failed') {
                                    $payment_status = '<span class="bg-red-500 px-3 py-1 text-white rounded shadow">Failed</span>';
                                }
                        @endphp
                        {!!$payment_status!!}


                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->

    <div class="flex flex-col gap-4 mt-4 md:flex-row">
        <div class="md:w-3/4">
            <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="font-semibold text-left">Ürün</th>
                            <th class="font-semibold text-left">Fiyat</th>
                            <th class="font-semibold text-left">Miktar</th>
                            <th class="font-semibold text-left">Toplam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <img class="w-16 h-16 mr-4" src="{{ url('storage', $item->product->images[0]) }}" alt="{{ $item->product->name }}">

                                    <span class="font-semibold">{{ $item->product->name}}</span>
                                </div>
                            </td>
                            <td class="py-4">{{ Number::currency($item->unit_amount)}}</td>
                            <td class="py-4">
                                <span class="w-8 text-center">{{ $item->quantity}}</span>
                            </td>
                            <td class="py-4">{{Number::currency($item->total_amount)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                <h1 class="mb-3 font-bold font-3xl text-slate-500">Teslimat Adresi</h1>
                <div class="flex items-center justify-between">
                    <div>
                        <p>{{ $address->street_adress}},{{ $address->city}},{{ $address->state}},{{ $address->zip_code}},</p>
                    </div>
                    <div>
                        <p class="font-semibold">Telefon:</p>
                        <p>{{ $address->phone}}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="md:w-1/4">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-lg font-semibold">Özet</h2>
                <div class="flex justify-between mb-2">
                    <span>Ara Toplam</span>
                    <span>{{Number::currency($Order->grand_total)}}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Vergiler</span>
                    <span>0.00</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Kargo</span>
                    <span>0.00</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Genel Toplam</span>
                    <span class="font-semibold">{{Number::currency($Order->grand_total)}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
