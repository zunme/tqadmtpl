import EasyMDE from 'easymde';
window.EasyMDE = EasyMDE

import Viewer from 'viewerjs';
window.Viewer = Viewer
window.viewimg = (e)=>{
    let src = e.target?.src
    if( !src ) return;
    let img_viewer = new Viewer(e.target, {
        inline: false,
        viewed() {
            img_viewer.zoomTo(1);
        },
        hide(){
            console.log( 'hide' )
            img_viewer.destroy()
        }

    });
    img_viewer.show()
}

import Pickr from '@simonwep/pickr';
if( typeof window.Pickr =='undefined') window.Pickr = Pickr

import moment from "moment/dist/moment"
import ko from "moment/dist/locale/ko"
moment.updateLocale("ko", ko)
if( typeof window.moment =='undefined') window.moment = moment;

import axios from 'axios';
if( typeof window.axios =='undefined') window.axios = axios;

import flatpickr from "flatpickr";
if( typeof window.flatpickr =='undefined') window.flatpickr = flatpickr;

import Pikaday from "pikaday";
if( typeof window.Pikaday =='undefined') window.Pikaday = Pikaday;

import Trix from "trix"
if( typeof window.Trix =='undefined') window.Trix = Trix;
