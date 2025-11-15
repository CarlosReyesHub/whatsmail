"use strict";
(self["webpackChunkwhatsmail_pro_version"] = self["webpackChunkwhatsmail_pro_version"] || []).push([["resources_js_pages_chat_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _assets_icons_image_png__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/assets/icons/image.png */ "./resources/js/assets/icons/image.png");
/* harmony import */ var _assets_icons_audio_png__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/assets/icons/audio.png */ "./resources/js/assets/icons/audio.png");
/* harmony import */ var _assets_icons_video_png__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/assets/icons/video.png */ "./resources/js/assets/icons/video.png");
/* harmony import */ var _assets_icons_documents_png__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/assets/icons/documents.png */ "./resources/js/assets/icons/documents.png");
/* harmony import */ var _assets_icons_map_png__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/assets/icons/map.png */ "./resources/js/assets/icons/map.png");
/* harmony import */ var nprogress__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! nprogress */ "./node_modules/nprogress/nprogress.js");
/* harmony import */ var nprogress__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(nprogress__WEBPACK_IMPORTED_MODULE_5__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
var _methods;
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }






/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {},
  data: function data() {
    return {
      intervalId: null,
      chatId: null,
      autoread: false,
      camera: {
        modal: false,
        picture: null,
        stream: null
      },
      fileTypes: ".pdf, .doc, .docx, .xlsx, .zip, .html, .php, .css, .js, .ppt, .txt",
      attribute: {
        image: _assets_icons_image_png__WEBPACK_IMPORTED_MODULE_0__["default"],
        audio: _assets_icons_audio_png__WEBPACK_IMPORTED_MODULE_1__["default"],
        video: _assets_icons_video_png__WEBPACK_IMPORTED_MODULE_2__["default"],
        document: _assets_icons_documents_png__WEBPACK_IMPORTED_MODULE_3__["default"],
        location: _assets_icons_map_png__WEBPACK_IMPORTED_MODULE_4__["default"],
        modal: false
      },
      message: {
        list: [],
        loader: true,
        last_chat: "",
        search: ""
      },
      send: {
        loader: false,
        type: "text",
        text: "",
        file: null,
        location: {
          "long": "",
          lang: ""
        }
      },
      file: {
        file: null,
        filePreview: null,
        previewType: "",
        fileName: "",
        isPDF: false
      }
    };
  },
  computed: {},
  methods: (_methods = {
    openModalCam: function openModalCam() {
      var _this = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var modal;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _this.camera.modal = true;
              modal = new bootstrap.Modal(_this.$refs.cameraModal, {
                backdrop: "static",
                keyboard: false
              });
              modal.show();
              _context.next = 5;
              return _this.openCamera();
            case 5:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }))();
    },
    openCamera: function openCamera() {
      var _this2 = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              _context2.prev = 0;
              _context2.next = 3;
              return navigator.mediaDevices.getUserMedia({
                video: true
              });
            case 3:
              _this2.camera.stream = _context2.sent;
              _this2.$refs.videoCamera.srcObject = _this2.camera.stream;
              _context2.next = 10;
              break;
            case 7:
              _context2.prev = 7;
              _context2.t0 = _context2["catch"](0);
              console.error("Kamera tidak dapat diakses", _context2.t0);
            case 10:
            case "end":
              return _context2.stop();
          }
        }, _callee2, null, [[0, 7]]);
      }))();
    },
    capturePhoto: function capturePhoto() {
      var canvas = this.$refs.canvas;
      var video = this.$refs.videoCamera;
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      var context = canvas.getContext("2d");
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      this.camera.picture = canvas.toDataURL("image/jpeg");
      if (this.camera.stream) {
        var tracks = this.camera.stream.getTracks();
        tracks.forEach(function (track) {
          return track.stop();
        });
      }
    },
    reTakePhoto: function reTakePhoto() {
      var _this3 = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              _this3.camera = {
                modal: false,
                picture: null,
                stream: null
              };
              _this3.openCamera();
            case 2:
            case "end":
              return _context3.stop();
          }
        }, _callee3);
      }))();
    },
    sendPhoto: function sendPhoto() {
      var _this4 = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
        var tracks, modal;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              _this4.send.type = "photo";
              _this4.send.file = _this4.camera.picture;
              if (_this4.camera.stream) {
                tracks = _this4.camera.stream.getTracks();
                tracks.forEach(function (track) {
                  return track.stop();
                });
              }
              _context4.next = 5;
              return _this4.sendMessage();
            case 5:
              _this4.camera = {
                modal: false,
                picture: null,
                stream: null
              };
              modal = document.getElementById("closeModalCamera");
              modal.click();
            case 8:
            case "end":
              return _context4.stop();
          }
        }, _callee4);
      }))();
    },
    closeModal: function closeModal() {},
    confirmFile: function confirmFile() {
      var _this5 = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
        return _regeneratorRuntime().wrap(function _callee5$(_context5) {
          while (1) switch (_context5.prev = _context5.next) {
            case 0:
              _context5.next = 2;
              return _this5.sendMessage();
            case 2:
              _this5.closeModal();
            case 3:
            case "end":
              return _context5.stop();
          }
        }, _callee5);
      }))();
    },
    closeCamera: function closeCamera() {
      if (this.camera.stream) {
        var tracks = this.camera.stream.getTracks();
        tracks.forEach(function (track) {
          return track.stop();
        });
      }
      this.camera = {
        modal: false,
        picture: null,
        stream: null
      };
    },
    triggerFileInput: function triggerFileInput() {
      this.$refs.fileInput.click();
    },
    setFileType: function setFileType(types) {
      var _this6 = this;
      this.fileTypes = types;
      setTimeout(function () {
        _this6.triggerFileInput();
      }, 1000);
    },
    handleFileChange: function handleFileChange(event) {
      var file = event.target.files[0];
      if (file) {
        this.file.fileName = file.name;
        this.send.file = file;
        if (file.type.startsWith("image")) {
          this.file.previewType = "image";
          this.file.filePreview = URL.createObjectURL(file);
          this.send.type = "media";
        } else if (file.type.startsWith("video")) {
          this.file.previewType = "video";
          this.file.filePreview = URL.createObjectURL(file);
          this.send.type = "media";
        } else if (file.type.startsWith("audio")) {
          this.file.previewType = "audio";
          this.file.filePreview = URL.createObjectURL(file);
          this.send.type = "media";
        } else if (file.type === "application/pdf") {
          this.file.previewType = "document";
          this.send.type = "document";
          this.file.filePreview = URL.createObjectURL(file);
          this.file.isPDF = true;
        } else {
          this.send.type = "document";
          this.file.previewType = "document";
          this.file.filePreview = null;
          this.file.isPDF = false;
        }

        // Show the modal
        var modal = new bootstrap.Modal(this.$refs.fileModal, {
          backdrop: "static",
          // mencegah modal tertutup dengan klik di luar
          keyboard: false // mencegah modal tertutup dengan tombol Esc
        });
        modal.show();
      }
    }
  }, _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_methods, "closeModal", function closeModal() {
    var modal = document.getElementById("closeModal");
    modal.click();
  }), "confirmFile", function confirmFile() {
    var _this7 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee6() {
      return _regeneratorRuntime().wrap(function _callee6$(_context6) {
        while (1) switch (_context6.prev = _context6.next) {
          case 0:
            _context6.next = 2;
            return _this7.sendMessage();
          case 2:
            _this7.closeModal();
          case 3:
          case "end":
            return _context6.stop();
        }
      }, _callee6);
    }))();
  }), "resetFile", function resetFile() {
    document.getElementById("files").value = "";
    this.send.type = "text";
    this.send.file = null;
    this.file.filePreview = null;
    this.file.fileName = "";
    this.file.previewType = "";
    this.file.isPDF = false;
  }), "getMessages", function getMessages() {
    var _arguments = arguments,
      _this8 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee7() {
      var lastChat, _this8$message$list, response, data, listData, toMarkRead;
      return _regeneratorRuntime().wrap(function _callee7$(_context7) {
        while (1) switch (_context7.prev = _context7.next) {
          case 0:
            lastChat = _arguments.length > 0 && _arguments[0] !== undefined ? _arguments[0] : "";
            _context7.prev = 1;
            _context7.next = 4;
            return _this8.$axios.get("/device/chats/detail/".concat(_this8.$route.params.id, "/").concat(_this8.$route.params.chatid, "?last_id=").concat(lastChat));
          case 4:
            response = _context7.sent;
            data = response.data;
            listData = Array.isArray(data.list) ? data.list : Object.values(data.list);
            listData = listData.filter(function (newItem) {
              return !_this8.message.list.some(function (existingItem) {
                return existingItem.id === newItem.id;
              });
            });
            _this8.chatId = data.chatid;
            _this8.message.loader = false;
            _this8.autoread = data.autoread;
            _this8.message.last_chat = data.last_chat;
            (_this8$message$list = _this8.message.list).push.apply(_this8$message$list, _toConsumableArray(listData));
            if (listData.length > 0) {
              _this8.scrollToBottom();
            }

            // function for mark to read message
            if (data.autoread) {
              toMarkRead = listData.filter(function (newItem) {
                return newItem.status === "UNREAD" && !newItem.sender;
              }).map(function (filteredItem) {
                return {
                  remoteJid: filteredItem.for_read.remoteJid,
                  id: filteredItem.id
                };
              });
              if (toMarkRead.length > 0) {
                _this8.markReadMessages(toMarkRead);
              }
            }
            _context7.next = 21;
            break;
          case 17:
            _context7.prev = 17;
            _context7.t0 = _context7["catch"](1);
            _this8.$handleErrorResponse(_context7.t0);
            console.log(_context7.t0);
          case 21:
          case "end":
            return _context7.stop();
        }
      }, _callee7, null, [[1, 17]]);
    }))();
  }), "markReadMessages", function markReadMessages(messages) {
    var _this9 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee8() {
      var response;
      return _regeneratorRuntime().wrap(function _callee8$(_context8) {
        while (1) switch (_context8.prev = _context8.next) {
          case 0:
            _context8.prev = 0;
            _context8.next = 3;
            return _this9.$axios.post("/device/misc/read-messages/".concat(_this9.$route.params.id), {
              chatid: _this9.chatId,
              messages: messages
            });
          case 3:
            response = _context8.sent;
            _context8.next = 9;
            break;
          case 6:
            _context8.prev = 6;
            _context8.t0 = _context8["catch"](0);
            console.log(_context8.t0);
          case 9:
          case "end":
            return _context8.stop();
        }
      }, _callee8, null, [[0, 6]]);
    }))();
  }), "deleteMessage", function deleteMessage(detail) {
    var _this10 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee9() {
      var messageIndex;
      return _regeneratorRuntime().wrap(function _callee9$(_context9) {
        while (1) switch (_context9.prev = _context9.next) {
          case 0:
            _context9.prev = 0;
            _context9.next = 3;
            return _this10.$axios.post("/device/misc/delete-message/".concat(_this10.$route.params.id), {
              chatid: _this10.chatId,
              message: {
                key: {
                  remoteJid: _this10.chatId,
                  fromMe: detail.sender,
                  id: detail.id
                },
                deleteMedia: detail.type == "text" && detail.type == "location" ? false : true,
                timestamp: detail.timestamp
              }
            });
          case 3:
            messageIndex = _this10.message.list.findIndex(function (i) {
              return detail.id == i.id;
            });
            if (messageIndex !== -1) {
              _this10.message.list.splice(messageIndex, 1);
            }
            _context9.next = 10;
            break;
          case 7:
            _context9.prev = 7;
            _context9.t0 = _context9["catch"](0);
            console.log(_context9.t0);
          case 10:
          case "end":
            return _context9.stop();
        }
      }, _callee9, null, [[0, 7]]);
    }))();
  }), "deleteEveryOne", function deleteEveryOne(detail) {
    var _this11 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee10() {
      var messageIndex;
      return _regeneratorRuntime().wrap(function _callee10$(_context10) {
        while (1) switch (_context10.prev = _context10.next) {
          case 0:
            _context10.prev = 0;
            _context10.next = 3;
            return _this11.$axios.post("/device/misc/delete-everyone/".concat(_this11.$route.params.id), {
              chatid: _this11.chatId,
              message: {
                remoteJid: _this11.chatId,
                fromMe: detail.sender,
                id: detail.id
              }
            });
          case 3:
            messageIndex = _this11.message.list.findIndex(function (i) {
              return detail.id == i.id;
            });
            if (messageIndex !== -1) {
              _this11.message.list.splice(messageIndex, 1);
            }
            _context10.next = 10;
            break;
          case 7:
            _context10.prev = 7;
            _context10.t0 = _context10["catch"](0);
            console.log(_context10.t0);
          case 10:
          case "end":
            return _context10.stop();
        }
      }, _callee10, null, [[0, 7]]);
    }))();
  }), "formattedText", function formattedText(message) {
    return message.replace(/\n/g, "<br>");
  }), "scrollToBottom", function scrollToBottom() {
    var messageContent = document.querySelector(".chat-area");
    if (messageContent) {
      messageContent.scrollTop = messageContent.scrollHeight;
    }
  }), "startPolling", function startPolling() {
    var _this12 = this;
    if (this.intervalId) clearInterval(this.intervalId);
    this.intervalId = setInterval(function () {
      if (_this12.$route.name == "chat_room") {
        if (!_this12.message.loader) {
          _this12.getMessages(_this12.message.last_chat);
        }
      } else {
        _this12.stopPolling();
      }
    }, 5000);
  }), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_methods, "stopPolling", function stopPolling() {
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId = null;
    }
  }), "downloadMedia", function downloadMedia(message, name, mime) {
    var _this13 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee11() {
      var response, data, findMessage;
      return _regeneratorRuntime().wrap(function _callee11$(_context11) {
        while (1) switch (_context11.prev = _context11.next) {
          case 0:
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().start();
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().set(0.1);
            _context11.prev = 2;
            _context11.next = 5;
            return _this13.$axios.post("/device/misc/download-media/".concat(_this13.$route.params.id), {
              type: mime,
              medianame: name,
              message: message
            });
          case 5:
            response = _context11.sent;
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().done();
            data = response.data;
            _this13.$showToast("Berhasil mengunduh media", "info", 3000);
            if (response.status == 200) {
              findMessage = _this13.message.list.findIndex(function (i) {
                return name == i.id;
              });
              if (findMessage !== -1) {
                _this13.message.list[findMessage].message.detail.url = data.data.downloadPath;
                _this13.message.list[findMessage].message.detail.asset = true;
              }
            }
            _context11.next = 16;
            break;
          case 12:
            _context11.prev = 12;
            _context11.t0 = _context11["catch"](2);
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().done();
            _this13.$showToast("Media gagal di unduh", "info", 3000);
          case 16:
          case "end":
            return _context11.stop();
        }
      }, _callee11, null, [[2, 12]]);
    }))();
  }), "autoResize", function autoResize() {
    var textarea = this.$refs.messageInput;
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
  }), "autoResizeModal", function autoResizeModal() {
    var textarea = this.$refs.messageInputModal;
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
  }), "handleEnter", function handleEnter(event) {
    if (!event.shiftKey) {
      event.preventDefault();
      this.sendMessage();
    }
  }), "autoResizeCamera", function autoResizeCamera() {
    var textarea = this.$refs.messageInputCamera;
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
  }), "insertLineBreak", function insertLineBreak() {
    var _this14 = this;
    this.send.text += "\n";
    this.$nextTick(function () {
      _this14.autoResize();
    });
  }), "sendMessage", function sendMessage() {
    var _this15 = this;
    return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee12() {
      var formData, response;
      return _regeneratorRuntime().wrap(function _callee12$(_context12) {
        while (1) switch (_context12.prev = _context12.next) {
          case 0:
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().start();
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().set(0.1);
            _this15.send.loader = true;
            _context12.prev = 3;
            formData = new FormData();
            formData.append("type", _this15.send.type);
            formData.append("phone", _this15.$route.params.chatid);
            formData.append("text", _this15.send.text);
            if (_this15.send.file) {
              if (_this15.send.type == "photo") {
                formData.append("photo", _this15.send.file);
              } else {
                formData.append("file", _this15.send.file);
              }
            }
            _context12.next = 11;
            return _this15.$axios.post("device/chats/send/".concat(_this15.$route.params.id), formData, {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            });
          case 11:
            response = _context12.sent;
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().done();
            _this15.send = {
              loader: false,
              type: "text",
              text: "",
              file: null,
              location: {
                "long": "",
                lang: ""
              }
            };
            _this15.resetFile();
            _this15.$showToast("Berhasil mengirim pesan", "info", 3000);
            _context12.next = 23;
            break;
          case 18:
            _context12.prev = 18;
            _context12.t0 = _context12["catch"](3);
            nprogress__WEBPACK_IMPORTED_MODULE_5___default().done();
            _this15.send.loader = false;
            _this15.$handleErrorResponse(_context12.t0);
          case 23:
          case "end":
            return _context12.stop();
        }
      }, _callee12, null, [[3, 18]]);
    }))();
  })),
  beforeDestroy: function beforeDestroy() {
    this.stopPolling();
  },
  updated: function updated() {
    this.scrollToBottom();
  },
  mounted: function mounted() {
    var _this16 = this;
    $(".chat-search-btn").on("click", function () {
      $(".chat-search").toggleClass("visible-chat");
    });
    $(".close-btn-chat").on("click", function () {
      $(".chat-search").removeClass("visible-chat");
    });
    $("#closeModal").on("click", function () {
      _this16.resetFile();
    });
    $("#closeModalCamera").on("click", function () {
      _this16.closeCamera();
    });
  },
  watch: {
    "$route.params.chatid": {
      handler: function handler() {
        var _this17 = this;
        this.stopPolling();
        if (this.$route.name == "chat_room") {
          this.message = {
            list: [],
            loader: true,
            last_chat: "",
            search: ""
          };
          this.getMessages("").then(function () {
            _this17.startPolling();
          });
        }
      },
      immediate: true
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41":
/*!*********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41 ***!
  \*********************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }

var _hoisted_1 = {
  "class": "chat chat-messages show",
  id: "middle"
};
var _hoisted_2 = {
  "class": "chat-header"
};
var _hoisted_3 = {
  "class": "user-details"
};
var _hoisted_4 = {
  "class": "avatar avatar-lg online flex-shrink-0"
};
var _hoisted_5 = ["src"];
var _hoisted_6 = {
  "class": "ms-2 overflow-hidden"
};
var _hoisted_7 = {
  "class": "chat-options"
};
var _hoisted_8 = {
  "class": "dropdown-menu dropdown-menu-end p-3"
};
var _hoisted_9 = {
  "class": "chat-search search-wrap contact-search"
};
var _hoisted_10 = {
  "class": "input-group"
};
var _hoisted_11 = {
  "class": "chat-body chat-page-group slimscroll"
};
var _hoisted_12 = {
  key: 0,
  "class": "d-flex justify-content-center"
};
var _hoisted_13 = {
  "class": "messages chat-area",
  style: {
    "overflow": "scroll",
    "height": "80vh"
  }
};
var _hoisted_14 = {
  "class": "chat-content"
};
var _hoisted_15 = {
  "class": "chat-time"
};
var _hoisted_16 = {
  key: 0,
  "class": "msg-read success"
};
var _hoisted_17 = {
  "class": "chat-info"
};
var _hoisted_18 = {
  key: 0,
  "class": "chat-img"
};
var _hoisted_19 = {
  "class": "img-wrap"
};
var _hoisted_20 = ["src"];
var _hoisted_21 = {
  "class": "img-overlay"
};
var _hoisted_22 = ["onClick"];
var _hoisted_23 = ["href", "title"];
var _hoisted_24 = {
  key: 1,
  "class": "chat-img"
};
var _hoisted_25 = {
  "class": "img-wrap"
};
var _hoisted_26 = ["src"];
var _hoisted_27 = {
  "class": "img-overlay"
};
var _hoisted_28 = ["onClick"];
var _hoisted_29 = {
  key: 2,
  "class": "message-video"
};
var _hoisted_30 = {
  controls: ""
};
var _hoisted_31 = ["src"];
var _hoisted_32 = {
  key: 3,
  "class": "chat-img"
};
var _hoisted_33 = {
  "class": "img-wrap"
};
var _hoisted_34 = ["src"];
var _hoisted_35 = {
  "class": "img-overlay"
};
var _hoisted_36 = ["onClick"];
var _hoisted_37 = {
  key: 4,
  "class": "message-audio"
};
var _hoisted_38 = {
  controls: ""
};
var _hoisted_39 = ["src"];
var _hoisted_40 = {
  key: 5,
  "class": "chat-img"
};
var _hoisted_41 = {
  "class": "img-wrap"
};
var _hoisted_42 = ["src"];
var _hoisted_43 = {
  "class": "img-overlay"
};
var _hoisted_44 = ["onClick"];
var _hoisted_45 = {
  key: 6,
  "class": "file-attach"
};
var _hoisted_46 = {
  "class": "ms-2 overflow-hidden"
};
var _hoisted_47 = {
  "class": "mb-1"
};
var _hoisted_48 = ["href"];
var _hoisted_49 = {
  key: 7,
  "class": "chat-img"
};
var _hoisted_50 = {
  "class": "img-wrap"
};
var _hoisted_51 = ["src"];
var _hoisted_52 = {
  "class": "img-overlay"
};
var _hoisted_53 = ["href"];
var _hoisted_54 = ["innerHTML"];
var _hoisted_55 = {
  key: 8,
  "class": "message-link"
};
var _hoisted_56 = ["href"];
var _hoisted_57 = {
  "class": "chat-actions"
};
var _hoisted_58 = {
  "class": "dropdown-menu dropdown-menu-end p-3"
};
var _hoisted_59 = ["onClick"];
var _hoisted_60 = {
  key: 0
};
var _hoisted_61 = ["onClick"];
var _hoisted_62 = {
  "class": "chat-footer"
};
var _hoisted_63 = {
  "class": "footer-form"
};
var _hoisted_64 = {
  "class": "chat-footer-wrap"
};
var _hoisted_65 = {
  "class": "form-wrap"
};
var _hoisted_66 = ["disabled"];
var _hoisted_67 = {
  "class": "form-item position-relative d-flex align-items-center justify-content-center"
};
var _hoisted_68 = ["accept"];
var _hoisted_69 = {
  "class": "form-item"
};
var _hoisted_70 = {
  "class": "dropdown-menu dropdown-menu-end p-3"
};
var _hoisted_71 = {
  "class": "form-btn"
};
var _hoisted_72 = ["disabled"];
var _hoisted_73 = {
  "class": "modal fade",
  id: "previewmodal",
  tabindex: "-1",
  "aria-labelledby": "filePreviewModalLabel",
  "aria-hidden": "true",
  ref: "fileModal"
};
var _hoisted_74 = {
  "class": "modal-dialog modal-dialog-centered modal-lg"
};
var _hoisted_75 = {
  "class": "modal-content"
};
var _hoisted_76 = {
  "class": "modal-header"
};
var _hoisted_77 = {
  "class": "modal-title"
};
var _hoisted_78 = {
  "class": "modal-body row"
};
var _hoisted_79 = {
  key: 0,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_80 = ["src"];
var _hoisted_81 = {
  key: 1,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_82 = {
  controls: ""
};
var _hoisted_83 = ["src"];
var _hoisted_84 = {
  key: 2,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_85 = {
  controls: ""
};
var _hoisted_86 = ["src"];
var _hoisted_87 = {
  key: 3,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_88 = ["src"];
var _hoisted_89 = ["src"];
var _hoisted_90 = {
  "class": "col-12 mt-4"
};
var _hoisted_91 = ["disabled"];
var _hoisted_92 = {
  "class": "modal-footer"
};
var _hoisted_93 = ["disabled"];
var _hoisted_94 = {
  "class": "modal fade",
  id: "cameraModal",
  tabindex: "-1",
  "aria-labelledby": "filePreviewModalLabel",
  "aria-hidden": "true",
  ref: "cameraModal"
};
var _hoisted_95 = {
  "class": "modal-dialog modal-dialog-centered modal-lg"
};
var _hoisted_96 = {
  "class": "modal-content"
};
var _hoisted_97 = {
  "class": "modal-body row"
};
var _hoisted_98 = {
  key: 0,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_99 = {
  ref: "videoCamera",
  autoplay: ""
};
var _hoisted_100 = {
  ref: "canvas",
  style: {
    "display": "none"
  }
};
var _hoisted_101 = {
  key: 1,
  "class": "col-12 d-flex justify-content-center"
};
var _hoisted_102 = ["src"];
var _hoisted_103 = {
  "class": "col-12 mt-4"
};
var _hoisted_104 = ["disabled"];
var _hoisted_105 = {
  "class": "modal-footer"
};
var _hoisted_106 = ["disabled"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_cache[22] || (_cache[22] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "d-xl-none"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "text-muted chat-close me-2",
    href: "#"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-arrow-left"
  })])], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: _ctx.$route.query.photo,
    "class": "rounded-circle",
    alt: "image"
  }, null, 8 /* PROPS */, _hoisted_5)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$route.query.name), 1 /* TEXT */), _cache[21] || (_cache[21] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "last-seen"
  }, "-", -1 /* HOISTED */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", null, [_cache[25] || (_cache[25] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "javascript:void(0)",
    "class": "btn chat-search-btn",
    "data-bs-toggle": "tooltip",
    "data-bs-placement": "bottom",
    title: "Search"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-search"
  })])], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [_cache[24] || (_cache[24] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "btn no-bg",
    href: "#",
    "data-bs-toggle": "dropdown"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-dots-vertical"
  })], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'blank_chat',
      params: {
        id: _ctx.$route.params.id
      }
    },
    "class": "dropdown-item"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return _cache[23] || (_cache[23] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
        "class": "ti ti-x me-2"
      }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Close Message")]);
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.message.search = $event;
    }),
    placeholder: "Search Message"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.message.search]]), _cache[26] || (_cache[26] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "input-group-text"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-search"
  })], -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [$data.message.loader ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_12, _cache[27] || (_cache[27] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "lds-roller"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div")], -1 /* HOISTED */)]))) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" List Message "), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.message.list.filter(function (item) {
    return item.message.detail.text.toLowerCase().includes($data.message.search.toLowerCase());
  }), function (list, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["chats", list.sender ? 'chats-right' : '']),
      key: index
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["chat-profile-name d-flex justify-content-end", list.sender ? 'me-4' : 'ms-4'])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(list.time), 1 /* TEXT */), list.status == 'READ' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_16, _toConsumableArray(_cache[28] || (_cache[28] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-checks"
    }, null, -1 /* HOISTED */)])))) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["message-content", list.message.type == 'audio' && !list.sender ? 'bg-transparent p-0' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Image not ready "), list.message.type == 'image' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: list.message.detail.asset ? list.message.detail.url : $data.attribute.image,
      alt: "img",
      style: (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeStyle)(!list.message.detail.asset ? 'height: 100%' : '')
    }, null, 12 /* STYLE, PROPS */, _hoisted_20), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [!list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 0,
      "class": "ti ti-download fs-30",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.downloadMedia(list.details, list.id, list.message.mime);
      }
    }, _toConsumableArray(_cache[29] || (_cache[29] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", null, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_22)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 1,
      "class": "gallery-img",
      "data-fancybox": "gallery-img",
      href: list.message.detail.url,
      title: list.message.detail.text
    }, _toConsumableArray(_cache[30] || (_cache[30] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-eye"
    }, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_23))])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Image not ready "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Video "), list.message.type == 'video' && !list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: $data.attribute.video,
      alt: "img",
      style: (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeStyle)(!list.message.detail.asset ? 'height: 100%' : '')
    }, null, 12 /* STYLE, PROPS */, _hoisted_26), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [!list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 0,
      "class": "ti ti-download fs-30",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.downloadMedia(list.details, list.id, list.message.mime);
      }
    }, _toConsumableArray(_cache[31] || (_cache[31] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", null, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_28)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), list.message.type == 'video' && list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("video", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("source", {
      src: list.message.detail.url,
      type: "video/mp4"
    }, null, 8 /* PROPS */, _hoisted_31)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Video "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Audio "), list.message.type == 'audio' && !list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: $data.attribute.audio,
      alt: "img",
      style: (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeStyle)(!list.message.detail.asset ? 'height: 100%' : '')
    }, null, 12 /* STYLE, PROPS */, _hoisted_34), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [!list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 0,
      "class": "ti ti-download fs-30",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.downloadMedia(list.details, list.id, list.message.mime);
      }
    }, _toConsumableArray(_cache[32] || (_cache[32] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", null, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_36)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), list.message.type == 'audio' && list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("audio", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("source", {
      src: list.message.detail.url,
      type: "audio/mpeg"
    }, null, 8 /* PROPS */, _hoisted_39)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Audio "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Document "), list.message.type == 'document' && !list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: $data.attribute.document,
      alt: "img",
      style: (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeStyle)(!list.message.detail.asset ? 'height: 100%' : '')
    }, null, 12 /* STYLE, PROPS */, _hoisted_42), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [!list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 0,
      "class": "ti ti-download fs-30",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.downloadMedia(list.details, list.id, list.message.mime);
      }
    }, _toConsumableArray(_cache[33] || (_cache[33] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", null, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_44)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), list.message.type == 'document' && list.message.detail.asset ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_45, [_cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
      "class": "file-icon"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-files"
    })], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", _hoisted_47, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(list.message.detail.title), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, " File " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(list.message.mime), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      target: "_blank",
      href: list.message.detail.url,
      "class": "download-icon"
    }, _toConsumableArray(_cache[34] || (_cache[34] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-download"
    }, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_48)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Document "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Location "), list.message.type == 'location' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: $data.attribute.location,
      alt: "img",
      style: {
        "height": "100%"
      }
    }, null, 8 /* PROPS */, _hoisted_51), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "ti ti-url fs-30",
      target: "_blank",
      href: list.message.detail.url
    }, _toConsumableArray(_cache[36] || (_cache[36] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", null, null, -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_53)])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Location "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      innerHTML: $options.formattedText(list.message.detail.text)
    }, null, 8 /* PROPS */, _hoisted_54), list.message.url != null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      href: list.message.url,
      target: "_blank",
      "class": "link-primary mt-2"
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(list.message.url), 9 /* TEXT, PROPS */, _hoisted_56)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" For Image "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [_cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "#",
      href: "#",
      "data-bs-toggle": "dropdown"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-dots-vertical"
    })], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <li>\n                                            <a\n                                                class=\"dropdown-item reply-btn\"\n                                                href=\"#\"\n                                                ><i\n                                                    class=\"ti ti-corner-up-left me-2\"\n                                                ></i\n                                                >Reply</a\n                                            >\n                                        </li> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "dropdown-item",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.deleteMessage(list);
      }
    }, _toConsumableArray(_cache[37] || (_cache[37] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-trash me-2"
    }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Delete Message")])), 8 /* PROPS */, _hoisted_59)]), list.sender ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "dropdown-item",
      href: "javascript:void(0);",
      onClick: function onClick($event) {
        return $options.deleteEveryOne(list);
      }
    }, _toConsumableArray(_cache[38] || (_cache[38] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": "ti ti-trash me-2"
    }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Pull Message")])), 8 /* PROPS */, _hoisted_61)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])])], 2 /* CLASS */);
  }), 128 /* KEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Message ")])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    placeholder: "Type Your Message",
    ref: "messageInput",
    rows: "1",
    disabled: $data.send.loader,
    onInput: _cache[1] || (_cache[1] = function () {
      return $options.autoResize && $options.autoResize.apply($options, arguments);
    }),
    onKeydown: [_cache[2] || (_cache[2] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)(function () {
      return $options.handleEnter && $options.handleEnter.apply($options, arguments);
    }, ["enter"])), _cache[3] || (_cache[3] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)((0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.insertLineBreak && $options.insertLineBreak.apply($options, arguments);
    }, ["shift", "prevent"]), ["enter"]))],
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $data.send.text = $event;
    })
  }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_66), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.send.text]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    onClick: _cache[5] || (_cache[5] = function ($event) {
      return $options.setFileType('.pdf, .doc, .docx, .xlsx, .zip, .html, .php, .css, .js, .ppt, .txt');
    }),
    "class": "action-circle position-absolute"
  }, _cache[40] || (_cache[40] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-file"
  }, null, -1 /* HOISTED */)])), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "file",
    "class": "open-file position-relative",
    name: "files",
    ref: "fileInput",
    id: "files",
    accept: $data.fileTypes,
    onChange: _cache[6] || (_cache[6] = function () {
      return $options.handleFileChange && $options.handleFileChange.apply($options, arguments);
    })
  }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_68)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    "data-bs-toggle": "dropdown"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-dots-vertical"
  })], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "javascript:void(0);",
    onClick: _cache[7] || (_cache[7] = function () {
      return $options.openModalCam && $options.openModalCam.apply($options, arguments);
    }),
    "class": "dropdown-item"
  }, _cache[41] || (_cache[41] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-camera-selfie me-2"
  }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Camera")])), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    "class": "dropdown-item",
    onClick: _cache[8] || (_cache[8] = function ($event) {
      return $options.setFileType('image/*');
    })
  }, _cache[42] || (_cache[42] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-photo-up me-2"
  }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Gallery ")])), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "#",
    "class": "dropdown-item",
    onClick: _cache[9] || (_cache[9] = function ($event) {
      return $options.setFileType('video/*');
    })
  }, _cache[43] || (_cache[43] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-video me-2"
  }, null, -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Video ")]))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-primary",
    type: "button",
    disabled: $data.send.loader,
    onClick: _cache[10] || (_cache[10] = function () {
      return $options.sendMessage && $options.sendMessage.apply($options, arguments);
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)($data.send.loader ? 'ti ti-circle' : 'ti ti-send')
  }, null, 2 /* CLASS */)], 8 /* PROPS */, _hoisted_72)])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Modal for update file "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", _hoisted_77, " Send " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.file.previewType == "document" ? "Dokument" : "Media"), 1 /* TEXT */), _cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "btn-close",
    id: "closeModal",
    "data-bs-dismiss": "modal"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-x"
  })], -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [$data.file.previewType === 'image' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $data.file.filePreview,
    alt: "Image Preview",
    "class": "img-fluid"
  }, null, 8 /* PROPS */, _hoisted_80)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.file.previewType === 'video' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("video", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("source", {
    src: $data.file.filePreview,
    type: "video/mp4"
  }, null, 8 /* PROPS */, _hoisted_83)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.file.previewType === 'audio' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("audio", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("source", {
    src: $data.file.filePreview,
    type: "audio/mpeg"
  }, null, 8 /* PROPS */, _hoisted_86)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.file.previewType === 'document' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_87, [$data.file.isPDF ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("embed", {
    key: 0,
    src: $data.file.filePreview,
    type: "application/pdf",
    width: "100%",
    height: "400px"
  }, null, 8 /* PROPS */, _hoisted_88)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("img", {
    key: 1,
    src: $data.attribute.document,
    "class": "w-50",
    alt: "img"
  }, null, 8 /* PROPS */, _hoisted_89))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_90, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    placeholder: "Type Your Message",
    ref: "messageInputModal",
    rows: "1",
    disabled: $data.send.loader,
    onInput: _cache[11] || (_cache[11] = function () {
      return $options.autoResizeModal && $options.autoResizeModal.apply($options, arguments);
    }),
    onKeydown: _cache[12] || (_cache[12] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)((0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.insertLineBreak && $options.insertLineBreak.apply($options, arguments);
    }, ["shift", "prevent"]), ["enter"])),
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $data.send.text = $event;
    })
  }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_91), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.send.text]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    disabled: $data.send.loader,
    "class": "btn btn-primary",
    onClick: _cache[14] || (_cache[14] = function () {
      return $options.confirmFile && $options.confirmFile.apply($options, arguments);
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.send.loader ? "Loading..." : "Send Message") + " ", 1 /* TEXT */), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-send ms-2"
  }, null, -1 /* HOISTED */))], 8 /* PROPS */, _hoisted_93)])])])], 512 /* NEED_PATCH */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Modal for update "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Modal For Take Photo "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [_cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "modal-header"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", {
    "class": "modal-title"
  }, "Take Photo"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "btn-close",
    id: "closeModalCamera",
    "data-bs-dismiss": "modal"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-x"
  })])], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [$data.camera.picture == null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_98, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("video", _hoisted_99, null, 512 /* NEED_PATCH */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("canvas", _hoisted_100, null, 512 /* NEED_PATCH */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.camera.picture != null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_101, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $data.camera.picture,
    alt: "Image Preview",
    "class": "img-fluid"
  }, null, 8 /* PROPS */, _hoisted_102)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    placeholder: "Type Your Message",
    ref: "messageInputCamera",
    rows: "1",
    disabled: $data.send.loader,
    onInput: _cache[15] || (_cache[15] = function () {
      return $options.autoResizeCamera && $options.autoResizeCamera.apply($options, arguments);
    }),
    onKeydown: _cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)((0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.insertLineBreak && $options.insertLineBreak.apply($options, arguments);
    }, ["shift", "prevent"]), ["enter"])),
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $data.send.text = $event;
    })
  }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_104), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.send.text]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_105, [$data.camera.picture == null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    type: "button",
    "class": "btn btn-primary",
    onClick: _cache[18] || (_cache[18] = function () {
      return $options.capturePhoto && $options.capturePhoto.apply($options, arguments);
    })
  }, _cache[47] || (_cache[47] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Take Foto "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-camera ms-2"
  }, null, -1 /* HOISTED */)]))) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.camera.picture != null && !$data.send.loader ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 1,
    type: "button",
    "class": "btn btn-primary me-2",
    onClick: _cache[19] || (_cache[19] = function () {
      return $options.reTakePhoto && $options.reTakePhoto.apply($options, arguments);
    })
  }, _cache[48] || (_cache[48] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Re-Take "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-camera ms-2"
  }, null, -1 /* HOISTED */)]))) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.camera.picture != null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 2,
    type: "button",
    disabled: $data.send.loader,
    onClick: _cache[20] || (_cache[20] = function () {
      return $options.sendPhoto && $options.sendPhoto.apply($options, arguments);
    }),
    "class": "btn btn-primary"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.send.loader ? "Loading..." : "Send Photo") + " ", 1 /* TEXT */), _cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "ti ti-send ms-2"
  }, null, -1 /* HOISTED */))], 8 /* PROPS */, _hoisted_106)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])], 512 /* NEED_PATCH */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" End Modal ")], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.lds-roller,\n.lds-roller div,\n.lds-roller div:after {\n    box-sizing: border-box;\n}\n.lds-roller {\n    display: inline-block;\n    position: relative;\n    width: 80px;\n    height: 80px;\n}\n.lds-roller div {\n    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;\n    transform-origin: 40px 40px;\n}\n.lds-roller div:after {\n    content: \" \";\n    display: block;\n    position: absolute;\n    width: 7.2px;\n    height: 7.2px;\n    border-radius: 50%;\n    background: currentColor;\n    color: #005d4c;\n    margin: -3.6px 0 0 -3.6px;\n}\n.lds-roller div:nth-child(1) {\n    animation-delay: -0.036s;\n}\n.lds-roller div:nth-child(1):after {\n    top: 62.62742px;\n    left: 62.62742px;\n}\n.lds-roller div:nth-child(2) {\n    animation-delay: -0.072s;\n}\n.lds-roller div:nth-child(2):after {\n    top: 67.71281px;\n    left: 56px;\n}\n.lds-roller div:nth-child(3) {\n    animation-delay: -0.108s;\n}\n.lds-roller div:nth-child(3):after {\n    top: 70.90963px;\n    left: 48.28221px;\n}\n.lds-roller div:nth-child(4) {\n    animation-delay: -0.144s;\n}\n.lds-roller div:nth-child(4):after {\n    top: 72px;\n    left: 40px;\n}\n.lds-roller div:nth-child(5) {\n    animation-delay: -0.18s;\n}\n.lds-roller div:nth-child(5):after {\n    top: 70.90963px;\n    left: 31.71779px;\n}\n.lds-roller div:nth-child(6) {\n    animation-delay: -0.216s;\n}\n.lds-roller div:nth-child(6):after {\n    top: 67.71281px;\n    left: 24px;\n}\n.lds-roller div:nth-child(7) {\n    animation-delay: -0.252s;\n}\n.lds-roller div:nth-child(7):after {\n    top: 62.62742px;\n    left: 17.37258px;\n}\n.lds-roller div:nth-child(8) {\n    animation-delay: -0.288s;\n}\n.lds-roller div:nth-child(8):after {\n    top: 56px;\n    left: 12.28719px;\n}\n@keyframes lds-roller {\n0% {\n        transform: rotate(0deg);\n}\n100% {\n        transform: rotate(360deg);\n}\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./resources/js/assets/icons/audio.png":
/*!*********************************************!*\
  !*** ./resources/js/assets/icons/audio.png ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/audio.png?46d84dece79a860e9e9680ee40dc2a53");

/***/ }),

/***/ "./resources/js/assets/icons/documents.png":
/*!*************************************************!*\
  !*** ./resources/js/assets/icons/documents.png ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/documents.png?449ba13cda9d456205f9f027f1fe4356");

/***/ }),

/***/ "./resources/js/assets/icons/image.png":
/*!*********************************************!*\
  !*** ./resources/js/assets/icons/image.png ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/image.png?5a26f50495a314ffa59fbb93402cc804");

/***/ }),

/***/ "./resources/js/assets/icons/map.png":
/*!*******************************************!*\
  !*** ./resources/js/assets/icons/map.png ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/map.png?82056140ce3605dfbf34029e764aae71");

/***/ }),

/***/ "./resources/js/assets/icons/video.png":
/*!*********************************************!*\
  !*** ./resources/js/assets/icons/video.png ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/video.png?825fa04ed0470feedc474ee57eb57f6a");

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_8_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_8_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_style_index_0_id_14ea6e41_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_8_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_8_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_style_index_0_id_14ea6e41_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_8_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_8_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_style_index_0_id_14ea6e41_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/pages/chat.vue":
/*!*************************************!*\
  !*** ./resources/js/pages/chat.vue ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _chat_vue_vue_type_template_id_14ea6e41__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./chat.vue?vue&type=template&id=14ea6e41 */ "./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41");
/* harmony import */ var _chat_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./chat.vue?vue&type=script&lang=js */ "./resources/js/pages/chat.vue?vue&type=script&lang=js");
/* harmony import */ var _chat_vue_vue_type_style_index_0_id_14ea6e41_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css */ "./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css");
/* harmony import */ var _Users_dedehidayatullah_Documents_myproject_bulk_message_marketing_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_Users_dedehidayatullah_Documents_myproject_bulk_message_marketing_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_chat_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_chat_vue_vue_type_template_id_14ea6e41__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/pages/chat.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/pages/chat.vue?vue&type=script&lang=js":
/*!*************************************************************!*\
  !*** ./resources/js/pages/chat.vue?vue&type=script&lang=js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./chat.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41":
/*!*******************************************************************!*\
  !*** ./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41 ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_template_id_14ea6e41__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_template_id_14ea6e41__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./chat.vue?vue&type=template&id=14ea6e41 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=template&id=14ea6e41");


/***/ }),

/***/ "./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css":
/*!*********************************************************************************!*\
  !*** ./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_8_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_8_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_chat_vue_vue_type_style_index_0_id_14ea6e41_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader/dist/cjs.js!../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-8.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-8.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/chat.vue?vue&type=style&index=0&id=14ea6e41&lang=css");


/***/ })

}]);