<div id="editMemberModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">


    <div class="fixed inset-0 bg-gray-900/50" onclick="closeEditModal()"></div>

    <div class="relative flex min-h-screen items-center justify-center p-4">

        <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        Edit Member
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Update member information.
                    </p>
                </div>

                <button type="button" onclick="closeEditModal()"
                    class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            {{-- Edit Form --}}
            <form id="editMemberForm" method="POST">

                @csrf
                @method('PUT')

                <div class="space-y-5 px-6 py-6">

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Member ID
                            </label>

                            <input type="text" name="member_id" id="edit_member_id" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select name="status" id="edit_status" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                First Name
                            </label>

                            <input type="text" name="first_name" id="edit_first_name" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Last Name
                            </label>

                            <input type="text" name="last_name" id="edit_last_name" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input type="email" name="email" id="edit_email" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Phone
                            </label>

                            <input type="text" name="phone" id="edit_phone"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Address
                            </label>

                            <textarea name="address" id="edit_address" rows="3"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"></textarea>
                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                    <button type="button" onclick="closeEditModal()"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Cancel
                    </button>

                    <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700">
                        Update Member
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
