  <div id="createMemberModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="createMemberModalTitle"
      role="dialog" aria-modal="true">

      <div class="fixed inset-0 bg-gray-900/50" onclick="closeCreateModal()"></div>

      <div class="relative flex min-h-screen items-center justify-center p-4">

          <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

              {{-- Header --}}
              <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                  <div>
                      <h2 id="createMemberModalTitle" class="text-lg font-semibold text-gray-900">
                          Add Member
                      </h2>

                      <p class="mt-1 text-sm text-gray-500">
                          Add a new library member.
                      </p>
                  </div>

                  <button type="button" onclick="closeCreateModal()"
                      class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>

              </div>

              {{-- Form --}}
              <form action="{{ route('members.store') }}" method="POST">

                  @csrf

                  <div class="space-y-5 px-6 py-6">

                      <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                          {{-- Member ID --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Member ID
                              </label>

                              <input type="text" name="member_id" value="{{ old('member_id') }}" required
                                  placeholder="e.g. MEM-001"
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                              @error('member_id')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- Status --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Status
                              </label>

                              <select name="status" required
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                                  <option value="active" @selected(old('status', 'active') === 'active')>
                                      Active
                                  </option>

                                  <option value="inactive" @selected(old('status') === 'inactive')>
                                      Inactive
                                  </option>
                              </select>

                              @error('status')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- First Name --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  First Name
                              </label>

                              <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                              @error('first_name')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- Last Name --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Last Name
                              </label>

                              <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                              @error('last_name')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- Email --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Email
                              </label>

                              <input type="email" name="email" value="{{ old('email') }}" required
                                  placeholder="member@example.com"
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                              @error('email')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- Phone --}}
                          <div>
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Phone
                              </label>

                              <input type="text" name="phone" value="{{ old('phone') }}"
                                  placeholder="09XXXXXXXXX"
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                              @error('phone')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                          {{-- Address --}}
                          <div class="sm:col-span-2">
                              <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                  Address
                              </label>

                              <textarea name="address" rows="3" placeholder="Enter member address..."
                                  class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ old('address') }}</textarea>

                              @error('address')
                                  <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                              @enderror
                          </div>

                      </div>

                  </div>

                  {{-- Footer --}}
                  <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                      <button type="button" onclick="closeCreateModal()"
                          class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                          Cancel
                      </button>

                      <button type="submit"
                          class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700">
                          Create Member
                      </button>

                  </div>

              </form>

          </div>

      </div>
  </div>
