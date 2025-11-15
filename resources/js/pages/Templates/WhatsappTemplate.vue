<template>
    <!-- Crate Template -->
    <form
        id="myForm"
        @submit.prevent="handleSubmit"
        enctype="multipart/form-data"
        method="POST"
        class="col-lg-8 col-sm-12"
    >
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a
                            href="javascript:void(0)"
                            class="nav-link"
                            :class="
                                form.type_content == 'description'
                                    ? 'active'
                                    : ''
                            "
                            @click="form.type_content = 'description'"
                            ><i class="ti ti-notes fs-16 me-2"></i> Text</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="javascript:void(0)"
                            class="nav-link"
                            :class="form.type_content == 'list' ? 'active' : ''"
                            @click="form.type_content = 'list'"
                            ><i class="ti ti-list fs-16 me-2"></i> List</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="javascript:void(0)"
                            class="nav-link"
                            :class="
                                form.type_content == 'button' ? 'active' : ''
                            "
                            @click="form.type_content = 'button'"
                            ><i class="ti ti-click fs-16 me-2"></i> Button</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="javascript:void(0)"
                            class="nav-link"
                            :class="
                                form.type_content == 'location' ? 'active' : ''
                            "
                            @click="form.type_content = 'location'"
                            ><i class="ti ti-map-pin-up fs-16 me-2"></i>
                            Location</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="javascript:void(0)"
                            class="nav-link"
                            :class="form.type_content == 'vote' ? 'active' : ''"
                            @click="form.type_content = 'vote'"
                            ><i class="ti ti-list-details fs-16 me-2"></i>
                            Poll</a
                        >
                    </li>
                    <li class="nav-item ms-auto">
                        <a
                            href="javascript:void(0)"
                            data-bs-toggle="modal"
                            data-bs-target="#modalInformation"
                            class="nav-link"
                        >
                            <i class="ti ti-info-circle fs-16"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show">
                        <div class="row">
                            <div
                                class="col-12 mb-1"
                                v-if="form.type_content == 'button'"
                            >
                                <div class="alert alert-warning" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <i
                                                class="ti ti-alert-triangle fs-16 me-2"
                                            ></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Warning</h4>
                                            <div class="text-secondary">
                                                The Message Button feature will
                                                only work on WhatsApp Web,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Insert Name</label>
                                <input
                                    class="form-control"
                                    v-model="form.name"
                                    type="text"
                                    required
                                />
                            </div>

                            <div
                                class="col-12 mb-3 mt-3"
                                v-if="
                                    form.type_content != 'location' &&
                                    form.type_content != 'vote' &&
                                    form.type_content != 'template' &&
                                    form.type_content != 'list'
                                "
                            >
                                <label class="form-label"
                                    >Header ( Optional )</label
                                >
                                <small
                                    >Add a title or select the media type you
                                    would like to use for this header.</small
                                >
                                <nav
                                    class="nav nav-tabs nav-justified d-sm-flex d-block"
                                >
                                    <a
                                        class="nav-link m-2 text-center"
                                        :class="
                                            form.media_type == 'text'
                                                ? 'active'
                                                : ''
                                        "
                                        style="
                                            border: 1px solid #00ceec;
                                            border-radius: 6px;
                                            display: flow;
                                        "
                                        @click="form.media_type = 'text'"
                                        href="javascript:void(0);"
                                        ><i
                                            class="ti ti-text-plus fs-16 me-2"
                                        ></i
                                        >Text</a
                                    >
                                    <a
                                        class="nav-link m-2 text-center"
                                        :class="
                                            form.media_type == 'image'
                                                ? 'active'
                                                : ''
                                        "
                                        style="
                                            border: 1px solid #00ceec;
                                            border-radius: 6px;
                                            display: flow;
                                        "
                                        @click="form.media_type = 'image'"
                                        href="javascript:void(0);"
                                        ><i class="ti ti-photo fs-16 me-2"></i
                                        >Image</a
                                    >
                                    <a
                                        class="nav-link m-2 text-center"
                                        :class="
                                            form.media_type == 'video'
                                                ? 'active'
                                                : ''
                                        "
                                        style="
                                            border: 1px solid #00ceec;
                                            border-radius: 6px;
                                            display: flow;
                                        "
                                        @click="form.media_type = 'video'"
                                        href="javascript:void(0);"
                                        ><i class="ti ti-video fs-16 me-2"></i
                                        >Video
                                    </a>
                                    <a
                                        class="nav-link m-2 text-center"
                                        :class="
                                            form.media_type == 'document'
                                                ? 'active'
                                                : ''
                                        "
                                        style="
                                            border: 1px solid #00ceec;
                                            border-radius: 6px;
                                            display: flow;
                                        "
                                        @click="form.media_type = 'document'"
                                        href="javascript:void(0);"
                                        ><i class="ti ti-file fs-16 me-2"></i
                                        >Dokumen
                                    </a>
                                    <a
                                        v-if="
                                            form.type_content == 'description'
                                        "
                                        class="nav-link m-2 text-center"
                                        :class="
                                            form.media_type == 'audio'
                                                ? 'active'
                                                : ''
                                        "
                                        style="
                                            border: 1px solid #00ceec;
                                            border-radius: 6px;
                                            display: flow;
                                        "
                                        @click="form.media_type = 'audio'"
                                        href="javascript:void(0);"
                                        ><i class="ti ti-music fs-16 me-2"></i
                                        >Audio</a
                                    >
                                </nav>
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="form.type_content == 'list'"
                            >
                                <label class="form-label">List Title</label>
                                <input
                                    class="form-control"
                                    v-model="form.list.title"
                                    placeholder="Insert Title"
                                    type="text"
                                />
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="form.type_content == 'list'"
                            >
                                <label class="form-label">Button Name</label>
                                <input
                                    class="form-control"
                                    v-model="form.list.button_name"
                                    placeholder="Insert Button Name"
                                    type="text"
                                />
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="form.type_content == 'vote'"
                            >
                                <label class="form-label">Question</label>
                                <input
                                    class="form-control"
                                    v-model="form.list.title"
                                    placeholder="Insert Question"
                                    type="text"
                                />
                            </div>

                            <div
                                class="col-lg-6 col-sm-12 mb-4"
                                v-if="form.type_content == 'location'"
                            >
                                <label class="form-label">Latitude</label>
                                <input
                                    class="form-control"
                                    v-model="form.lang"
                                    placeholder="Ex: -6.940262"
                                    type="text"
                                />
                            </div>

                            <div
                                class="col-lg-6 col-sm-12 mb-4"
                                v-if="form.type_content == 'location'"
                            >
                                <label class="form-label">Longitude</label>
                                <input
                                    class="form-control"
                                    v-model="form.long"
                                    placeholder="Ex: 106.456678"
                                    type="text"
                                />
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="
                                    form.media_type != '' &&
                                    form.media_type != null &&
                                    form.media_type != 'text'
                                "
                            >
                                <label class="form-label headerlabel"
                                    >Upload Media
                                </label>
                                <input
                                    class="form-control"
                                    type="file"
                                    @change="handleFileUpload"
                                    id="fileInput"
                                />
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="
                                    form.type_content != 'location' &&
                                    form.type_content != 'vote' &&
                                    form.media_type != 'audio'
                                "
                            >
                                <label class="form-label"
                                    >Insert Body Message</label
                                >
                                <textarea
                                    class="form-control"
                                    style="height: 200px"
                                    v-model="form.body_message"
                                    required
                                ></textarea>
                            </div>

                            <div
                                class="col-12 mb-4"
                                v-if="
                                    form.type_content == 'list' ||
                                    form.type_content == 'button'
                                "
                            >
                                <label class="form-label">Footer Text</label>
                                <input
                                    class="form-control"
                                    v-model="form.footer_message"
                                    placeholder="Insert Footer Text"
                                    type="text"
                                />
                            </div>

                            <div class="col-12 row">
                                <div
                                    class="col-6 mb-2"
                                    v-if="form.type_content == 'list'"
                                >
                                    <button
                                        class="btn btn-secondary add-call w-100"
                                        type="button"
                                        data-type="call"
                                        @click="addButton('list')"
                                    >
                                        Add List
                                    </button>
                                </div>
                                <div
                                    class="col-6 mb-2"
                                    v-if="form.type_content == 'button'"
                                >
                                    <button
                                        class="btn btn-secondary add-web w-100"
                                        type="button"
                                        data-type="web"
                                        @click="addButton('button')"
                                    >
                                        Add Button
                                    </button>
                                </div>
                                <div
                                    class="col-6 mb-2"
                                    v-if="form.type_content == 'vote'"
                                >
                                    <button
                                        class="btn btn-secondary add-copy w-100"
                                        type="button"
                                        data-type="copy"
                                        @click="addButton('vote')"
                                    >
                                        Add Option
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 row p-0">
                                <!-- For List Buttons -->
                                <div
                                    class="col-12 callbutton mt-2"
                                    v-if="form.type_content == 'list'"
                                    v-for="(listItem, li) in form.list.sections"
                                    :key="li"
                                >
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    List Section
                                                </th>
                                                <th
                                                    class="d-flex justify-content-end"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline btn-info me-2"
                                                        @click="addList(li)"
                                                    >
                                                        <i
                                                            class="ti ti-circle-plus fs-16 text-gray"
                                                        ></i>
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline btn-secondary"
                                                        @click="
                                                            removeButton(
                                                                li,
                                                                'list'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="ti ti-x fs-16 text-gray"
                                                        ></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder="Section Name"
                                                        required
                                                        v-model="listItem.title"
                                                    />
                                                </td>
                                            </tr>
                                            <tr
                                                v-for="(
                                                    segment, s
                                                ) in listItem.rows"
                                                :key="s"
                                            >
                                                <td>
                                                    <label class="form-label"
                                                        >List Name</label
                                                    >
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        required
                                                        v-model="segment.title"
                                                    />
                                                </td>
                                                <td>
                                                    <label class="form-label"
                                                        >List Description</label
                                                    >
                                                    <input
                                                        class="form-control"
                                                        type="text" 
                                                        v-model="
                                                            segment.description
                                                        "
                                                    />
                                                </td>
                                                <td
                                                    class="align-items-center"
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                    v-if="s != 0"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline btn-danger"
                                                        @click="
                                                            removeList(li, s)
                                                        "
                                                    >
                                                        <i
                                                            class="ti ti-x fs-16 text-gray"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End For List -->

                                <!-- Button -->
                                <div
                                    class="col-12 callbutton mt-2"
                                    v-if="form.type_content == 'button'"
                                    v-for="(item, index) in form.buttons"
                                    :key="index"
                                >
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Custom Button
                                                </th>
                                                <th
                                                    class="d-flex justify-content-end"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline btn-secondary"
                                                        @click="
                                                            removeButton(
                                                                index,
                                                                'button'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="ti ti-x fs-16 text-gray"
                                                        ></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <label class="form-label"
                                                        >Button Text</label
                                                    >
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        required
                                                        v-model="
                                                            item.button_name
                                                        "
                                                    />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Button -->

                                <!-- Options -->
                                <div
                                    class="col-12 callbutton mt-2"
                                    v-if="form.type_content == 'vote'"
                                    v-for="(option, o) in form.options"
                                    :key="o"
                                >
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Answer Options
                                                </th>
                                                <th
                                                    class="d-flex justify-content-end"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline btn-secondary"
                                                        @click="
                                                            removeButton(
                                                                index,
                                                                'vote'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="ti ti-x fs-16 text-gray"
                                                        ></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <label class="form-label"
                                                        >Option</label
                                                    >
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        required
                                                        v-model="option.name"
                                                    />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Options -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="loader.submit"
                >
                    <i class="ti ti-device-floppy fs-16 me-1"></i
                    >{{
                        loader.submit
                            ? "Loading...."
                            : type.id == null
                            ? "Add Template"
                            : "Save Changes"
                    }}
                </button>
            </div>
        </div>
    </form>
    <!-- End Create -->

    <!-- Preview Template -->
    <div
        class="col-lg-4 col-sm-12 whatsapp-chat-body"
        pattern="https://res.cloudinary.com/eventbree/image/upload/v1575854793/Widgets/whatsapp-bg.png"
    >
        <div class="whatsapp-chat-bubble">
            <div class="whatsapp-chat-message-loader" style="opacity: 0">
                <div style="position: relative; display: flex">
                    <div class="ixsrax"></div>
                    <div class="dRvxoz"></div>
                    <div class="kXBtNt"></div>
                </div>
            </div>
            <div class="whatsapp-chat-message" style="opacity: 1">
                <div class="bMIBDo">Saripa Rahmat</div>
                <div
                    class="iSpIQi text-center"
                    v-if="form.media_type != 'text'"
                    style="padding: 50px; background-color: darkgrey"
                >
                    <i
                        class="ti ti-photo-plus text-center text-white icon-image"
                        v-if="form.media_type == 'image'"
                        style="font-size: 50px"
                    ></i>
                    <i
                        class="ti ti-video text-center text-white icon-video"
                        v-if="form.media_type == 'video'"
                        style="font-size: 50px"
                    ></i>
                    <i
                        class="ti ti-file-type-pdf text-center text-white icon-document"
                        v-if="form.media_type == 'document'"
                        style="font-size: 50px"
                    ></i>
                    <i
                        class="ti ti-music text-center text-white icon-document"
                        v-if="form.media_type == 'audio'"
                        style="font-size: 50px"
                    ></i>
                </div>
                <div
                    class="iSpIQi text-center"
                    v-if="form.type_content == 'location'"
                    style="padding: 50px; background-color: darkgrey"
                >
                    <i
                        class="ti ti-map-pin text-center text-white icon-image"
                        style="font-size: 50px"
                    ></i>
                </div>
                <div
                    class="iSpIQi"
                    v-if="
                        (form.type_content == 'list' &&
                            form.list.title != '' &&
                            form.list.title != null) ||
                        (form.type_content == 'button' &&
                            form.list.title != '' &&
                            form.list.title != null)
                    "
                >
                    {{ form.list.title }}
                </div>
                <div
                    class="iSpIQi"
                    v-if="
                        form.type_content == 'vote' &&
                        form.list.title != '' &&
                        form.list.title != null
                    "
                >
                    {{ form.list.title }}
                </div>
                <div
                    class="iSpIQe"
                    v-if="
                        form.type_content != 'location' &&
                        form.type_content != 'vote' &&
                        form.media_type != 'audio' &&
                        form.body_message != ''
                    "
                >
                    {{ form.body_message }}
                </div>
                <div
                    class="iSpIQe mt-2"
                    v-if="
                        form.type_content == 'vote' && form.options.length > 0
                    "
                >
                    <div>
                        <label
                            class="form-check"
                            v-for="(option, o) in form.options"
                        >
                            <input
                                class="form-check-input"
                                type="radio"
                                name="radios"
                            />
                            <span class="form-check-label">{{
                                option.name
                            }}</span>
                        </label>
                    </div>
                </div>
                <div
                    class="iSpIQd"
                    v-if="
                        (form.type_content == 'list' &&
                            form.footer_message != '') ||
                        (form.type_content == 'button' &&
                            form.footer_message != '')
                    "
                >
                    {{ form.footer_message }}
                </div>
                <div class="cqCDVm">10:51</div>
            </div>
        </div>
        <div id="listButton">
            <div
                class="whatsapp-chat-bubble phone-call"
                v-if="form.type_content == 'list'"
            >
                <div class="whatsapp-chat-message-loader" style="opacity: 0">
                    <div style="position: relative; display: flex">
                        <div class="ixsrax"></div>
                        <div class="dRvxoz"></div>
                        <div class="kXBtNt"></div>
                    </div>
                </div>
                <div class="whatsapp-chat-button text-info" style="opacity: 1">
                    <div class="iSpIQi text-center">
                        <i class="ti ti-list fs-16 me-2"></i>
                        <span>{{ form.list.button_name }}</span>
                    </div>
                </div>
            </div>
            <div
                class="whatsapp-chat-bubble phone-call"
                v-if="form.type_content == 'button'"
                v-for="(item, index) in form.buttons"
            >
                <div class="whatsapp-chat-message-loader" style="opacity: 0">
                    <div style="position: relative; display: flex">
                        <div class="ixsrax"></div>
                        <div class="dRvxoz"></div>
                        <div class="kXBtNt"></div>
                    </div>
                </div>
                <div class="whatsapp-chat-button text-info" style="opacity: 1">
                    <div class="iSpIQi text-center">
                        <span>{{ item.button_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preview -->

    <!-- Modal For Information -->
    <div
        class="modal fade"
        id="modalInformation"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="modalInformationLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalInformationLabel">
                        Applicable Parameters
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body row p-2">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        Daftar Kode yang dapat digunakan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>{whatsapp_name}</b>
                                    </td>
                                    <td>
                                        Username on Whatsapp (Valid only for
                                        Auto Reply)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>{store}</b>
                                    </td>
                                    <td>
                                        Untuk Meyisipkan Nama Pelanggan /
                                        Destinasi
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>{phone}</b>
                                    </td>
                                    <td>Untuk Meyisipkan Nomor Ponsel</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>{email}</b>
                                    </td>
                                    <td>Untuk Meyisipkan Email</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>{address}</b>
                                    </td>
                                    <td>Untuk Menyisipkan Alamat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Information -->
</template>

<script>
export default {
    components: {},
    data() {
        return {
            type: {
                form: "create",
                device: "",
                id: null,
            },
            form: {
                name: "",
                type_content: "description",
                media_type: "text",
                header_text: "",
                body_message: "",
                footer_message: "",
                image: "",
                lang: "",
                long: "",
                buttons: [],
                options: [],
                list: {
                    title: "",
                    button_name: "",
                    sections: [],
                },
            },
            file: null,
            maxform: {
                call: 1,
                web: 2,
                copy: 1,
                custom: 6,
            },
            loader: {
                submit: false,
            },
        };
    },
    computed: {},
    methods: {
        addButton(type) {
            var max = this.maxform;

            if (type == "list") {
                this.form.list.sections.push({
                    title: "",
                    rows: [
                        {
                            title: "",
                            description: "",
                        },
                    ],
                });
            }

            if (type == "button") {
                this.form.buttons.push({
                    button_name: "",
                });
            }

            if (type == "vote") {
                this.form.options.push({
                    name: "",
                });
            }
        },

        addList(index) {
            this.form.list.sections[index].rows.push({
                title: "",
                description: "",
            });
        },

        removeList(index, item) {
            this.form.list.sections[index].rows.splice(item, 1);
        },

        removeButton(index, type) {
            if (type == "list") {
                this.form.list.sections.splice(index, 1);
            }

            if (type == "button") {
                this.form.buttons.splice(index, 1);
            }

            if (type == "vote") {
                this.form.options.splice(index, 1);
            }
        },

        async handleSubmit() {
            const formData = new FormData();

            for (const key in this.form) {
                if (key === "image" && this.form[key]) {
                    formData.append(
                        key,
                        this.form.image == null || this.form.image == ""
                            ? null
                            : this.form[key]
                    );
                } else if (Array.isArray(this.form[key])) {
                    this.form[key].forEach((item, index) => {
                        if (key === "buttons") {
                            formData.append(
                                `${key}[${index}][button_name]`,
                                item.button_name
                            );
                        } else if (key === "options") {
                            formData.append(
                                `${key}[${index}][name]`,
                                item.name
                            );
                        } else {
                            formData.append(
                                `${key}[${index}]`,
                                JSON.stringify(item)
                            );
                        }
                    });
                } else if (
                    key === "list" &&
                    typeof this.form[key] === "object"
                ) {
                    for (const subKey in this.form[key]) {
                        if (
                            subKey === "sections" &&
                            Array.isArray(this.form[key][subKey])
                        ) {
                            this.form[key][subKey].forEach(
                                (section, sectionIndex) => {
                                    formData.append(
                                        `${key}[${subKey}][${sectionIndex}][title]`,
                                        section.title
                                    );

                                    if (Array.isArray(section.rows)) {
                                        section.rows.forEach(
                                            (row, rowIndex) => {
                                                for (const rowKey in row) {
                                                    formData.append(
                                                        `${key}[${subKey}][${sectionIndex}][rows][${rowIndex}][${rowKey}]`,
                                                        row[rowKey]
                                                    );
                                                }
                                            }
                                        );
                                    }
                                }
                            );
                        } else {
                            formData.append(
                                `${key}[${subKey}]`,
                                this.form[key][subKey]
                            );
                        }
                    }
                } else {
                    formData.append(key, this.form[key]);
                }
            }

            try {
                this.loader.submit = true;

                var url = `/master/templates/store`;

                if (this.type.form == "update") {
                    var url = `/master/templates/edit/${this.type.id}`;
                }
                const response = await this.$axios.post(url, formData);

                this.$showToast(response.data.message, "info", 3000);

                setTimeout(() => {
                    window.location.href = `/app/master/templates`;
                }, 3000);
            } catch (error) {
                this.loader.submit = false;
                this.$showToast(error.response.data.message, "error", 3000);
            }
        },

        handleFileUpload(event) {
            this.form.image = event.target.files[0];
        },

        async getDetails() {
            try {
                const response = await this.$axios.get(
                    `/master/templates/details/${this.type.id}`
                );

                var data = response.data;
                this.form = data.details;
            } catch (error) {
                this.$showToast(error.response.data.message, "error", 3000);
            }
        },
    },
    beforeDestroy() {},
    updated() {},
    mounted() {
        // Mendapatkan path lengkap dari URL
        const path = window.location.pathname;

        // Memecah path berdasarkan "/"
        const segments = path.split("/");
        const lastSegment = segments.filter((segment) => segment !== "").pop();

        if (segments.length == 5) {
            this.type = {
                form: "create",
                device: "",
                id: null,
            };
        } else {
            this.type = {
                form: "update",
                device: "",
                id: lastSegment,
            };

            this.getDetails();
        }
    },
    watch: {
        "form.type_content"(newValue) {
            if (newValue != "description" && this.form.media_type == "audio") {
                this.form.media_type = "text";
            }

            if (
                newValue == "location" ||
                newValue == "vote" ||
                newValue == "list"
            ) {
                this.form.media_type = "text";
            }
        },
    },
};
</script>
